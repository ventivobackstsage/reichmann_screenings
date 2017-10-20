<?php
	/**
	 * Created by PhpStorm.
	 * User: danpetrescu
	 * Date: 20/10/2017
	 * Time: 12:30
	 */
	namespace App\Facades;

	use App\Classes\SmartBillCloudRestClientClass;
	use Illuminate\Support\Facades\Facade;

	class SmartBill extends Facade
	{
		protected static function getFacadeAccessor()
		{
			return SmartBillCloudRestClientClass::class;
		}
	}