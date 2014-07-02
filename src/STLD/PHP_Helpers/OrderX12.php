<?php namespace STLD\PHP_Helpers;
/*
|--------------------------------------------------------------------------
| Send X12 Order to Send The Light Distribution
|--------------------------------------------------------------------------
|
| 	Please note this is not meant to be a full X12 850 class,
|	but rather a quick wrapper to send orders to STLD
|
*/
class OrderX12
{
	protected $order;

	function __construct(array $conf)
	{
		$this->san           = str_pad($conf['san'],7,0,STR_PAD_LEFT);
		$this->order_num     = (isset($conf['order_num']) ? $conf['order_num'] : mt_rand(9,9999999999));
		$this->po_num        = (isset($conf['po_num']) ? $conf['po_num'] : date('ydmhis')); // 140625130139
		$this->backorders    = $conf['backorders'];
		$this->company       = $conf['company'];
		$this->total_ordered = 0;

		$this->order = new \stdClass;
		$this->order->items = array();
		
		self::addHeader();
		self::addBackorders();
		self::addBillto();
		self::addFooter();

		return $this->order;
	}
	
	/**
	 * Add header elements
	 * 
	 * @return  string
	 */
	function addHeader()
	{
		$date = date("ymd");
		$time = date("Hi");
		$order_num_pad = str_pad($this->order_num,9,0,STR_PAD_LEFT);

		$this->order->header  = 'ISA*00*          *01*          *ZZ*'.$this->san.'*ZZ*1697889*'.$date.'*'.$time.'*U*00200*'.$order_num_pad.'*0*T*>'.PHP_EOL;
		$this->order->header .= 'GS*PO*'.$this->san.'*1697889*'.$date.'*'.$time.'**X*003020BISAC2'.PHP_EOL;
		$this->order->header .= 'ST*850*'.$this->order_num.PHP_EOL;
		$this->order->header .= 'BEG*00*NE*'.$this->po_num.'**'.$date.'**AE'.PHP_EOL;
				
		return $this->order;
	}

	/**
	 * Add footer elements
	 * Also gets called each time a new item is added to order
	 * to recalculate item and line totals
	 * 
	 * @return  string
	 */
	function addFooter()
	{
		// (items * 2) + (shipping line) + (BEG line + CTT line)
		$segements = (count($this->order->items) * 2) + (isset($this->order->shipping) ? 1 : 0) + 2;

		$this->order->footer  = 'CTT*'.(count($this->order->items)).'*'.$this->total_ordered.PHP_EOL;
		$this->order->footer .= 'SE*'.$segements.'*'.$this->order_num.PHP_EOL;
		$this->order->footer .= 'GE*1*'.$this->order_num.PHP_EOL;
		$this->order->footer .= 'IEA*1*'.$this->order_num.PHP_EOL;

		return $this;
	}

	/**
	 * Add backorder line
	 * Defaults to 'N' for no backorders
	 *
	 * @return  string
	 */
	public function addBackorders()
	{
		$flag = strtoupper($this->backorders);
		$bo_flags = array(
			'B' => 'only new titles',
			'C' => 'combine with next order',
			'N' => 'no backorders',
			'O' => 'only out of stock items',
			'Y' => 'yes backorders',
		);
		if(!isset($bo_flags[$flag])){$flag = 'N';}

		$this->order->backorders = 'CSH*'.$flag.PHP_EOL;
		return $this;
	}

	/**
	 * Add basic bill-to line
	 *
	 * @return  string
	 */
	public function addbillTo()
	{
		$this->order->billto = 'N1*BS*'.$this->company.'*91*'.$this->san.PHP_EOL;
		return $this;
	}

	/**
	 * Add shipping method line
	 * 
	 * @param  string $method valid shipping method
	 * @return string
	 */
	public function shipping($method)
	{
		$this->order->shipping = 'TD5****T*'.$method.PHP_EOL;
		return $this;
	}

	/**
	 * Ship-to info for dropshipment
	 * 
	 * @param  array  $shipto shipping address info (see docs to available fields)
	 * @return string
	 */
	public function shipTo(array $shipto)
	{
		$this->order->shipto  = 'N1*ST*'.(isset($shipto['company']) ? $shipto['company'] : '').'*91*'.$this->san.PHP_EOL;
		$this->order->shipto .= 'N2*'.$shipto['name'].PHP_EOL;;
		$this->order->shipto .= 'N3*'.$shipto['address1'].'*'.(isset($shipto['address2']) ? $shipto['address2'] : '').'*'.(isset($shipto['address3']) ? $shipto['address3'] : '').''.PHP_EOL;
		$this->order->shipto .= 'N4*'.$shipto['city'].'*'.$shipto['state'].'*'.$shipto['zip'].'*'.$shipto['country'].PHP_EOL;

		// change billto segment if there's a shipto address
		$this->order->billto = 'N1*BT*'.$this->company.'*91*'.$this->san.PHP_EOL;

		return $this;
	}

	/**
	 * Adds item to order
	 * 
	 * @param  string $item_id ean, isbn13, upc or isbn
	 * @param  int    $qty     quantity     
	 * @return string
	 */
	public function addItem($item_id,$qty)
	{
		$item_id_types = array('10'=>'IB','12'=>'UP','13'=>'EN');
		
		$item_id_type = 'EN'; // defaults to EAN/ISBN13
		if(isset($item_id_types[strlen($item_id)])){
			$item_id_type = $item_id_types[strlen($item_id)];
		}

		$this->order->items[] = 'PO1*'.count($this->order->items).'*'.$qty.'****'.$item_id_type.'*'.$item_id.PHP_EOL.'CTP**PUR'.PHP_EOL;
		$this->total_ordered += $qty;
		
		// recreate footer each time an item is added to re-calculate order totals
		self::addFooter();

		return $this->order;
	}

	/**
	 * Formats order in proper order for writing to a file or printing to screen
	 * 
	 * @return string
	 */
	public function __toString()
	{
		$order  = $this->order->header;
		$order .= $this->order->backorders;
		$order .= $this->order->billto;
		$order .= (isset($this->order->shipto) ? $this->order->shipto : '');
		$order .= implode('',array_values($this->order->items));
		$order .= $this->order->footer;

		return $order;
	}
}