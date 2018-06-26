<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'prevent-back-history'],function(){
    Route::get('/', 'UserLoginController@index');
    Route::get('/register',function(){
    	return view('register');
    });
    Route::post('/login', ['as'=>'user.auth','uses'=>'UserLoginController@login']);
    //Route::post('/login/add_client_info','UserLoginController@add_client_info');
    //Route::get('/login/add_client_info','UserLoginController@add_client_info');
    //Route::post('signup','UserLoginController@signup');
    Route::post('back','UserLoginController@back');
	//Route::get('signup','UserLoginController@signup');
	Route::get('/logout','UserLoginController@logout');
	Route::get('/home','UserController@index');
    Route::get('/home/dashboard/{token}','Dashboard@index');

	/*************************password reset***************************************/
	Route::get('/send', 'ResetPasswordController@sendLink');
    Route::post('password/sendLink', 'ResetPasswordController@sendLink');
    Route::get('password/sendLink', 'ResetPasswordController@sendLink');

    Route::post('password/reset/{token}', 'ResetPasswordController@showResetForm');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm');
    
    Route::get('password/reset', 'ResetPasswordController@reset');
    Route::post('password/reset', 'ResetPasswordController@reset');
    /*******************************End********************************************/

    /* ADMIN */

    /**********************show IT admin forms **************************************/
    //Route::get('/home/admin/dashboard/{token}','AdminController@showDashboard');
    Route::get('/home/IT-admin/addEmployee/{token}','AdminController@showAddEmployee');
    Route::get('/home/IT-admin/modifyEmployee/{token}','AdminController@showModifyEmployee');
    Route::get('/home/IT-admin/addEditPost/{token}','AdminController@showAddEditPost');
    Route::get('/home/IT-admin/addEditWorkCharge/{token}','AdminController@showAddEditWorkCharge');
    Route::get('/home/IT-admin/addDepartment/{token}','AdminController@showAddEditDepartment');
    Route::get('/home/IT-admin/addRole/{token}','AdminController@showAddEditRole');
    Route::get('/home/IT-admin/state/{token}','AdminController@showState');
    Route::get('/home/IT-admin/district/{token}','AdminController@showDistrict');
    Route::get('/home/IT-admin/city/{token}','AdminController@showCity');
    Route::get('/home/IT-admin/area/{token}','AdminController@showArea');
    /*********************************End*******************************************/


    /******************************IT Admin Ajax**************************************/
    Route::get('/getSuperior/ajax/{id}',array('as'=>'adminAddUser.ajax','uses'=>'Admin@getSuperior'));
    

    Route::get('/getMenuSubMenu/ajax/',array('as'=>'adminAddEmployee.ajax','uses'=>'Admin@getMenuSubMenu'));
    Route::get('/getCountry/ajax/',array('as'=>'adminAddEmployee.ajax','uses'=>'Admin@getCountry'));
    Route::get('/getDistrict/ajax/',array('as'=>'adminAddEmployee.ajax','uses'=>'Admin@getDistrict'));
    Route::get('/getState/ajax/',array('as'=>'adminAddEmployee.ajax','uses'=>'Admin@getState'));
    Route::get('/getAreaType/ajax/',array('as'=>'adminAddUser.ajax','uses'=>'Admin@getAreaType'));
    Route::get('/getDepartment/ajax/',array('as'=>'adminAddEmployee.ajax','uses'=>'Admin@getDepartment'));
    Route::get('/getPost/ajax/',array('as'=>'adminAddEmployee.ajax','uses'=>'Admin@getPost'));


    Route::get('/getEditMenuSubMenu/ajax/',array('as'=>'adminModifyEmployee.ajax','uses'=>'Admin@getEditMenuSubMenu'));
    Route::get('/getEmployeeUsername/ajax/',array('as'=>'adminModifyEmployee.ajax','uses'=>'Admin@getEmployeeUsername'));
    Route::get('/getEmployeePost/ajax/',array('as'=>'adminModifyEmployee.ajax','uses'=>'Admin@getEmployeePost'));
    Route::get('/getEmployeeDepartment/ajax/',array('as'=>'adminModifyEmployee.ajax','uses'=>'Admin@getEmployeeDepartment'));
    Route::get('/getEmployeeAreaType/ajax/',array('as'=>'adminModifyEmployee.ajax','uses'=>'Admin@getEmployeeAreaType'));
    Route::get('/getEmployeeArea/ajax/',array('as'=>'adminModifyEmployee.ajax','uses'=>'Admin@getEmployeeArea'));
    Route::get('/getITAdminCount/ajax/',array('as'=>'adminDashboard.ajax','uses'=>'Admin@getITAdminCount'));
    Route::get('/getMonthWiseEmployeeCreated/ajax/',array('as'=>'adminDashboard.ajax','uses'=>'Admin@getMonthWiseEmployeeCreated'));
    Route::get('/getDepartmentWiseEmployeeCount/ajax/',array('as'=>'adminDashboard.ajax','uses'=>'Admin@getDepartmentWiseEmployeeCount'));
    Route::get('/getPostWiseEmployeeCount/ajax/',array('as'=>'adminDashboard.ajax','uses'=>'Admin@getPostWiseEmployeeCount'));

    /*********************************End*******************************************/

    /****************************Admin Operations***********************************/
    Route::get('/home/admin/state/addState/{token}','AdminAddOperationController@addState');
    Route::post('/home/admin/state/addState/{token}','AdminAddOperationController@addState');
    Route::get('/home/admin/state/updateState/{token}','AdminEditOperationController@updateState');
    Route::post('/home/admin/state/updateState/{token}','AdminEditOperationController@updateState');
    #Route::get('/home/admin/state/insertStateBulk','AdminOperationController@insertStateBulk');
    #Route::post('/home/admin/state/insertStateBulk','AdminOperationController@insertStateBulk');


    Route::get('/home/admin/district/addDistrict/{token}','AdminAddOperationController@addDistrict');
    Route::post('/home/admin/district/addDistrict/{token}','AdminAddOperationController@addDistrict');
    Route::get('/home/admin/district/updateDistrict/{token}','AdminEditOperationController@updateDistrict');
    Route::post('/home/admin/district/updateDistrict/{token}','AdminEditOperationController@updateDistrict');
    #Route::get('/home/admin/state/insertDistrictBulk','AdminOperationController@insertDistrictBulk');
    #Route::post('/home/admin/state/insertDistrictBulk','AdminOperationController@insertDistrictBulk');


    Route::get('/home/admin/city/addCity/{token}','AdminAddOperationController@addCity');
    Route::post('/home/admin/city/addCity/{token}','AdminAddOperationController@addCity');
    Route::get('/home/admin/city/updateCity/{token}','AdminEditOperationController@updateCity');
    Route::post('/home/admin/city/updateCity/{token}','AdminEditOperationController@updateCity');
    #Route::get('/home/admin/city/insertCityBulk','AdminOperationController@insertCityBulk');
    #Route::post('/home/admin/city/insertCityBulk','AdminOperationController@insertCityBulk');


    Route::get('/home/admin/area/addArea/{token}','AdminAddOperationController@addArea');
    Route::post('/home/admin/area/addArea/{token}','AdminAddOperationController@addArea');
    Route::get('/home/admin/area/updateArea/{token}','AdminEditOperationController@updateArea');
    Route::post('/home/admin/area/updateArea/{token}','AdminEditOperationController@updateArea');
    #Route::get('/home/admin/area/insertAreaBulk','AdminOperationController@insertAreaBulk');
    #Route::post('/home/admin/area/insertAreaBulk','AdminOperationController@insertAreaBulk');



    Route::get('/home/admin/department/addDepartment/{token}','AdminAddOperationController@addDepartment');
    Route::post('/home/admin/department/addDepartment/{token}','AdminAddOperationController@addDepartment');
    Route::get('/home/admin/department/updateDepartment/{token}','AdminEditOperationController@updateDepartment');
    Route::post('/home/admin/department/updateDepartment/{token}','AdminEditOperationController@updateDepartment');


    Route::get('/home/admin/role/addRole/{token}','AdminAddOperationController@addRole');
    Route::post('/home/admin/role/addRole/{token}','AdminAddOperationController@addRole');
    Route::get('/home/admin/role/updateRole/{token}','AdminEditOperationController@updateRole');
    Route::post('/home/admin/role/updateRole/{token}','AdminEditOperationController@updateRole');


    Route::get('/home/admin/employee/addEmployee/{token}','AdminAddOperationController@addEmployee');
    Route::post('/home/admin/employee/addEmployee/{token}','AdminAddOperationController@addEmployee');
    Route::get('/home/admin/employee/updateEmployee/{token}','AdminEditOperationController@updateEmployee');
    Route::post('/home/admin/employee/updateEmployee/{token}','AdminEditOperationController@updateEmployee');


 	Route::get('/home/admin/post/addPost/{token}','AdminAddOperationController@addPost');
    Route::post('/home/admin/post/addPost/{token}','AdminAddOperationController@addPost');
    Route::get('/home/admin/post/updatePost/{token}','AdminEditOperationController@updatePost');
    Route::post('/home/admin/post/updatePost/{token}','AdminEditOperationController@updatePost');
       
    Route::get('/home/admin/post/addWorkCharge/{token}','AdminAddOperationController@addWorkCharge');
    Route::post('/home/admin/post/addWorkCharge/{token}','AdminAddOperationController@addWorkCharge');
    Route::get('/home/admin/post/updateWorkCharge/{token}','AdminEditOperationController@updateWorkCharge');
    Route::post('/home/admin/post/updateWorkCharge/{token}','AdminEditOperationController@updateWorkCharge');
    


    /**********************************End*******************************************************************/

    /****************************************System Admin show form***************************************************/
    
     Route::get('/home/sysAdmin/assetModel/{token}','SysAdmin@showAssetModel');
     Route::get('/home/sysAdmin/location/{token}','SysAdmin@showLocation');

     Route::get('/home/sysAdmin/addComponent/{token}','SysAdmin@showAddComponent');
     Route::get('/home/sysAdmin/editComponent/{token}','SysAdmin@showEditComponent');

     Route::get('/home/sysAdmin/addConsumable/{token}','SysAdmin@showAddConsumable');
     Route::get('/home/sysAdmin/editConsumable/{token}','SysAdmin@showEditConsumable');

     Route::get('/home/sysAdmin/addAccessory/{token}','SysAdmin@showAddAccessory');
     Route::get('/home/sysAdmin/editAccessory/{token}','SysAdmin@showEditAccessory');

     Route::get('/home/sysAdmin/addLicense/{token}','SysAdmin@showAddLicense');
     Route::get('/home/sysAdmin/editLicense/{token}','SysAdmin@showEditLicense');

     Route::get('/home/sysAdmin/addAsset/{token}','SysAdmin@showAddAsset');
     Route::get('/home/sysAdmin/editAsset/{token}','SysAdmin@showEditAsset');

    //Route::get('/home/sysAdmin/allocateAssets/{token}','SysAdmin@showAllocateAssets');
    /******************************************End*************************************************************/
    
    /*****************************************System Admin Ajax******************************************************/
    Route::get('/getAsset/ajax/',array('as'=>'systemAdminAllocateAsset.ajax','uses'=>'SysAdmin@getAsset'));
     Route::get('/getSysAdminEmployee/ajax/',array('as'=>'systemAdminAllocateAsset.ajax','uses'=>'SysAdmin@getEmployee'));
    /**********************************************End*****************************************************************/
    
     /****************************************System Admin Operation***************************************************/
    Route::get('/home/sysAdmin/addAsset/add/{token}','SysAdminOperation@addAsset');
    Route::post('/home/sysAdmin/addAsset/add/{token}','SysAdminOperation@addAsset');

    Route::get('/home/sysAdmin/editAsset/update/{token}','SysAdminOperation@updateAsset');
    Route::post('/home/sysAdmin/editAsset/update/{token}','SysAdminOperation@updateAsset');

    #Route::get('/home/sysAdmin/allocateAssets/allocate/{token}','SysAdminOperation@allocateAsset');
    #Route::post('/home/sysAdmin/allocateAssets/allocate/{token}','SysAdminOperation@allocateAsset');

    Route::get('/home/sysAdmin/addAssetModel/add/{token}','SysAdminOperation@addAssetModel');
    Route::post('/home/sysAdmin/addAssetModel/add/{token}','SysAdminOperation@addAssetModel');

    Route::get('/home/sysAdmin/updateAssetModel/update/{token}','SysAdminOperation@updateAssetModel');
    Route::post('/home/sysAdmin/updateAssetModel/update/{token}','SysAdminOperation@updateAssetModel');


    Route::get('/home/sysAdmin/addLocation/add/{token}','SysAdminOperation@addLocation');
    Route::post('/home/sysAdmin/addLocation/add/{token}','SysAdminOperation@addLocation');

    Route::get('/home/sysAdmin/updateLocation/update/{token}','SysAdminOperation@updateLocation');
    Route::post('/home/sysAdmin/updateLocation/update/{token}','SysAdminOperation@updateLocation');


    Route::get('/home/sysAdmin/addComponent/add/{token}','SysAdminOperation@addComponent');
    Route::post('/home/sysAdmin/addComponent/add/{token}','SysAdminOperation@addComponent');

     Route::get('/home/sysAdmin/updateComponent/update/{token}','SysAdminOperation@updateComponent');
    Route::post('/home/sysAdmin/updateComponent/update/{token}','SysAdminOperation@updateComponent');


    Route::get('/home/sysAdmin/addConsumable/add/{token}','SysAdminOperation@addConsumable');
    Route::post('/home/sysAdmin/addConsumable/add/{token}','SysAdminOperation@addConsumable');

    Route::get('/home/sysAdmin/updateConsumable/update/{token}','SysAdminOperation@updateConsumable');
    Route::post('/home/sysAdmin/updateConsumable/update/{token}','SysAdminOperation@updateConsumable');

    Route::get('/home/sysAdmin/addAccessory/add/{token}','SysAdminOperation@addAccessory');
    Route::post('/home/sysAdmin/addAccessory/add/{token}','SysAdminOperation@addAccessory');

    Route::get('/home/sysAdmin/updateAccessory/update/{token}','SysAdminOperation@updateAccessory');
    Route::post('/home/sysAdmin/updateAccessory/update/{token}','SysAdminOperation@updateAccessory');

    Route::get('/home/sysAdmin/addLicense/add/{token}','SysAdminOperation@addLicense');
    Route::post('/home/sysAdmin/addLicense/add/{token}','SysAdminOperation@addLicense');

    Route::get('/home/sysAdmin/updateLicense/update/{token}','SysAdminOperation@updateLicense');
    Route::post('/home/sysAdmin/updateLicense/update/{token}','SysAdminOperation@updateLicense');


    /******************************************End*************************************************************/






    /* Marketing Executive */

    /******************************Show Marketing Executive Form*********************/
    Route::get('/home/mrkExecutive/{token}','UserController@index');
    Route::get('/home/mrk/dashboard/{token}','MrkDashboard@showDashboard');
    Route::get('/home/mrkExecutive/addLead/{token}','MrkExecutive@showAddLead');
    Route::get('/home/mrkExecutive/leadActionResponse/{token}','MrkExecutive@showActionResponse');
    Route::get('/home/mrkExecutive/todayTasks/{token}','MrkExecutive@showTodayTasks');
    Route::get('/home/mrkExecutive/monthTasks/{token}','MrkExecutive@showMonthTasks');
    Route::get('/home/mrkExecutive/overDueTasks/{token}','MrkExecutive@showOverDueTasks');
    Route::get('/home/mrkExecutive/completedTasks/{token}','MrkExecutive@showCompletedTasks');
    Route::get('/home/mrkExecutive/sendToApprove/{token}','MrkExecutive@showSendToApprove');
    /****************************************End*************************************/

    /******************************Marketing Executive Operations*********************/
    Route::get('/home/mrkExecutive/addLead/add/{token}','MrkExecutiveOperation@addLead');
    Route::post('/home/mrkExecutive/addLead/add/{token}','MrkExecutiveOperation@addLead');

    Route::get('/home/mrkExecutive/leadAction/addAction/{token}','MrkExecutiveOperation@addAction');
    Route::post('/home/mrkExecutive/leadAction/addAction/{token}','MrkExecutiveOperation@addAction');

    Route::get('/home/mrkExecutive/leadResponse/addResponse/{token}','MrkExecutiveOperation@addResponse');
    Route::post('/home/mrkExecutive/leadResponse/addResponse/{token}','MrkExecutiveOperation@addResponse');

    Route::get('/home/mrkExecutive/todayTasks/updateStatus/{token}','MrkExecutiveOperation@updateTaskStatus');
    Route::post('/home/mrkExecutive/todayTasks/updateStatus/{token}','MrkExecutiveOperation@updateTaskStatus');

    Route::get('/home/mrkExecutive/sendToApprove/send/{token}','MrkExecutiveOperation@sendToApprove');
    Route::post('/home/mrkExecutive/sendToApprove/send/{token}','MrkExecutiveOperation@sendToApprove');

     Route::get('/home/mrkExecutive/addToArchive/archive/{token}','MrkExecutiveOperation@addToArchive');
    Route::post('/home/mrkExecutive/addToArchive/archive/{token}','MrkExecutiveOperation@addToArchive');

    /****************************************End*************************************/


    /******************************Marketing Executive Ajax*********************/
    Route::get('/getAction/ajax/{id}',array('as'=>'mrkExecutiveActionResponse.ajax','uses'=>'MrkExecutiveOperation@getAction'));
    Route::get('/getResponse/ajax/{id}',array('as'=>'mrkExecutiveAactionResponse.ajax','uses'=>'MrkExecutiveOperation@getResponse'));
    Route::get('/checkAnyNewTasks/ajax/',array('as'=>'master.master.ajax','uses'=>'MrkExecutiveOperation@anyNewTasks'));
    Route::get('/getServiceSubTypes/ajax/{id}',array('as'=>'mekExecutiveAddLead.ajax','uses'=>'MrkExecutiveOperation@getServiceSubTypes'));
    Route::get('/todayFollowUp/ajax/',array('as'=>'mekExecutiveAddLead.ajax','uses'=>'MrkExecutiveOperation@todayFollowUp'));
    Route::get('/followUp/ajax/',array('as'=>'mekExecutiveAddLead.ajax','uses'=>'MrkExecutiveOperation@followUp'));
    Route::get('/closeLeads/ajax/',array('as'=>'mekExecutiveAddLead.ajax','uses'=>'MrkExecutiveOperation@closeLeads'));
    Route::get('/newFollowUp/ajax/',array('as'=>'mekExecutiveAddLead.ajax','uses'=>'MrkExecutiveOperation@newFollowUp'));
    Route::get('/archiveLeads/ajax/',array('as'=>'mekExecutiveAddLead.ajax','uses'=>'MrkExecutiveOperation@archiveLeads'));
    /****************************************End*************************************/
    /*****************************Marketing (Manager,Executive) Dashboards*************/
    Route::get('/home/mrk/dashboard','MrkDashboard@showDashboard');
    /*********************************************************************************/

    /***************************Marketing Manager Show Forms**************************/
    Route::get('/home/mrkManager/manageLead/{token}','MrkManager@showManageLead');
     Route::get('/home/mrkManager/approveQuotation/{token}','MrkManager@showApproveQuotation');
     Route::get('/home/mrkManager/disApproveQuotation/{token}','MrkManager@showDisApproveQuotation');
     Route::get('/home/mrkManager/addCustomer/{token}','MrkManager@showAddCustomer');
     Route::get('/home/mrkManager/editCustomer/{token}','MrkManager@showEditCustomer');
    /**********************************End********************************************/
    /***************************Marketing Manager Ajax**************************/
    Route::get('/getActionResponse/ajax/{id}',array('as'=>'mrkManagerManageLead.ajax','uses'=>'MrkManagerOperation@getActionResponse'));
    Route::get('/getAccounts/ajax/',array('as'=>'mrkManagerApproveQuotation.ajax','uses'=>'MrkManagerOperation@getAccounts'));
    /**********************************End********************************************/
    /***************************Marketing Manager Do Operations**************************/
    Route::get('/home/mrkManager/manageLead/addTask/{token}','MrkManagerOperation@addTask');
    Route::post('/home/mrkManager/manageLead/addTask/{token}','MrkManagerOperation@addTask');

    Route::get('/home/mrkManager/approveQuotation/approve/{token}','MrkManagerOperation@approveQuotation');
    Route::post('/home/mrkManager/approveQuotation/approve/{token}','MrkManagerOperation@approveQuotation');

     Route::get('/home/mrkManager/addCustomer/add/{token}','MrkManagerOperation@addCustomer');
    Route::post('/home/mrkManager/addCustomer/add/{token}','MrkManagerOperation@addCustomer');

    Route::get('/home/mrkManager/editCustomer/edit/{token}','MrkManagerOperation@editCustomer');
    Route::post('/home/mrkManager/editCustomer/edit/{token}','MrkManagerOperation@editCustomer');

    Route::get('/home/mrkManager/resendRequest/resend/{token}','MrkManagerOperation@resendRequest');
    Route::post('/home/mrkManager/resendRequest/resend/{token}','MrkManagerOperation@resendRequest');
    /**********************************End********************************************/


    /*******************************Supervisor show Forms*******************************/
    Route::get('/home/supervisor/dashboard','Supervisor@showDashboard');
    Route::get('/home/supervisor/viewCall/{token}','Supervisor@showViewCall');
    Route::get('/home/supervisor/allocateCall/{token}','Supervisor@showAllocateCall');
    Route::get('/home/supervisor/closeCall/{token}','Supervisor@showCloseCall');
    /*************************************End*******************************************/

    /*******************************Supervisor Ajax Operation*******************************/
    Route::get('/supervisorGetEngineer/ajax/',array('as'=>'supervisorViewCall.ajax','uses'=>'SupervisorOperation@getEngineer'));
    Route::get('/supervisorGetAllocatedData/ajax/',array('as'=>'supervisorAllocateCall.ajax','uses'=>'SupervisorOperation@getAllocatedData'));
    /*************************************End*******************************************/

    /*******************************Supervisor Operations*******************************/
    Route::get('/home/supervisor/viewCall/allocateCall/{token}','SupervisorOperation@allocateCall');
    Route::post('/home/supervisor/viewCall/allocateCall/{token}','SupervisorOperation@allocateCall');
    Route::get('/home/supervisor/allocateCall/updateAllocateCall/{token}','SupervisorOperation@updateAllocateCall');
    Route::post('/home/supervisor/allocateCall/updateAllocateCall/{token}','SupervisorOperation@updateAllocateCall');
    /*************************************End*******************************************/


     /*******************************Engineer show Forms*******************************/
    Route::get('/home/engineer/dashboard','Engineer@showDashboard');
    Route::get('/home/engineer/viewCall','Supervisor@showViewCall');
    /*************************************End*******************************************/

    /*******************************Engineer Ajax Operation*******************************/
    /*************************************End*******************************************/

    /*******************************Engineer Operations*******************************/
    /*************************************End*******************************************/

    /********************************Sales Show Forms************************************************************/
    Route::get('/home/sales/sendQuotation/{token}','Sales@showSendQuotation');
    Route::get('/home/sales/viewQuotation/{token}','Sales@showViewQuotation');
    Route::get('/home/sales/sendSalesOrder/{token}','Sales@showSendSalesOrder');
    Route::get('/home/sales/viewSalesOrder/{token}','Sales@showViewSalesOrder');

    /***********************************End*******************************************************************/

    /********************************Sales Operation *********************************************/

    Route::get('/home/mrkExecutive/addQuotation/{token}','SalesOperation@addQuotation');
    Route::post('/home/mrkExecutive/addQuotation/{token}','SalesOperation@addQuotation');

    Route::get('/home/mrkManager/updateQuotation/{token}','SalesOperation@updateQuotation');
    Route::post('/home/mrkManager/updateQuotation/{token}','SalesOperation@updateQuotation');

    Route::get('/quotation','Sales@showQu');
    Route::get('/downloadQuotation','Sales@downloadQuotation');
    Route::get('/sendQuotation','Sales@sendQuotation');
    Route::post('/sendQuotation','Sales@sendQuotation');

    Route::get('/resendQuotation','Sales@resendQuotation');
    Route::post('/resendQuotation','Sales@resendQuotation');

    Route::get('/home/sales/viewCustomer/addSalesOrder/{token}','SalesOperation@addSalesOrder');
    Route::post('/home/sales/viewCustomer/addSalesOrder/{token}','SalesOperation@addSalesOrder'); 
    Route::get('/downloadSalesOrder','Sales@downloadSalesOrder');
    Route::get('/sendSalesOrder','Sales@sendSalesOrder');
    Route::post('/sendSalesOrder','Sales@sendSalesOrder');
    /*********************************************End************************************************************/

    /********************************Sales Ajax************************************************************/
    Route::get('/itemAuto/ajax/',array('as'=>'salesViewLead.ajax','uses'=>'Sales@getItems'));
    Route::get('/item_info/ajax/{id}',array('as'=>'salesViewLead.ajax','uses'=>'Sales@getItemDiscription'));
    Route::get('/item_infoQuotation/ajax/{id}',array('as'=>'salesViewLead.ajax','uses'=>'Sales@getQuotationItemDiscription'));
    Route::get('/setQuotationSession/ajax/',array('as'=>'salesViewQuotation.ajax','uses'=>'Sales@setQuotationSession'));
    Route::get('/setSalesOrderSession/ajax/',array('as'=>'salesViewSalesOrder.ajax','uses'=>'Sales@setSalesOrderSession'));
    Route::get('/getSites/ajax/',array('as'=>'salesSendQuotation.ajax','uses'=>'Sales@getSites'));
    Route::get('/getWarehouse/ajax/{id}',array('as'=>'salesSendQuotation.ajax','uses'=>'Sales@getWarehouse'));
   
    Route::get('/service_info/ajax/{id}',array('as'=>'salesSendSalesOrder.ajax','uses'=>'Sales@service_infoAjax'));
    Route::get('/serviceAuto/ajax/{service}',array('as'=>'mrkExecutiveSendToApprove.ajax','uses'=>'Sales@serviceAutoAjax'));
    Route::get('/getQuotation/ajax/',array('as'=>'mrkManagerEditQuotation.ajax','uses'=>'Sales@getQuotation'));

    /***********************************End*******************************************************************/



    /***************************Production Manager Show forms***************************************************/
    Route::get('/home/production/goods/{token}','ProductionInventory@viewItems');
    Route::get('/home/production/services/{token}','ProductionInventory@viewServices');
    Route::get('/home/production/stock/{token}','ProductionInventory@viewStock');
    Route::get('/home/production/sites/{token}','ProductionInventory@showSite');
    Route::get('/home/production/wareHouse/{token}','ProductionInventory@showWarehouse');
    Route::get('/home/production/brand/{token}','ProductionInventory@showBrand');
    Route::get('/home/production/category/{token}','ProductionInventory@showCategory');
    Route::get('/home/production/itemHSN/{token}','ProductionInventory@showItemHSN');
    Route::get('/home/production/serviceSAC/{token}','ProductionInventory@showServiceSAC');
    /*******************************End*************************************************************************/

     /***************************Production Manager Ajax***************************************************/
        Route::get('stockAlert/ajax/',array('as'=>'stockAlert.ajax','uses'=>'ProductionInventoryAjax@stockAlertAjax'));
  Route::get('item_name/ajax/{id}',array('as'=>'item_name.ajax','uses'=>'ProductionInventoryAjax@item_nameAjax'));
  Route::get('item_type/ajax/',array('as'=>'item_type.ajax','uses'=>'ProductionInventoryAjax@item_typeAjax'));    
  Route::get('hsn/ajax/{id}',array('as'=>'hsn.ajax','uses'=>'ProductionInventoryAjax@hsnAjax'));
  Route::get('Category/ajax/',array('as'=>'Category.ajax','uses'=>'ProductionInventoryAjax@categoryAjax'));
  Route::get('Group/ajax/',array('as'=>'Group.ajax','uses'=>'ProductionInventoryAjax@groupAjax'));  
  Route::get('Brand/ajax/',array('as'=>'Brand.ajax','uses'=>'ProductionInventoryAjax@brandAjax'));
  Route::get('site/ajax/',array('as'=>'site.ajax','uses'=>'ProductionInventoryAjax@siteAjax'));
  Route::get('warehouse/ajax/{id}',array('as'=>'warehouse.ajax','uses'=>'ProductionInventoryAjax@warehouseAjax'));

  Route::get('service_type/ajax/',array('as'=>'service_type.ajax','uses'=>'ProductionInventoryAjax@service_typeAjax'));
  Route::get('service_name/ajax/{id}',array('as'=>'service_name.ajax','uses'=>'ProductionInventoryAjax@service_nameAjax'));
  Route::get('SAC/ajax/{id}',array('as'=>'SAC.ajax','uses'=>'ProductionInventoryAjax@sacAjax'));
  Route::get('Warehouse/ajax/',array('as'=>'Warehouse.ajax','uses'=>'ProductionInventoryAjax@warehouseAjax'));
    /*******************************End*************************************************************************/

     /***************************Production Manager Operations***************************************************/
    Route::post('home/addItem/{token}','ProductionInventoryOperation@addItem');
    Route::post('home/updateItem/{token}','ProductionInventoryOperation@updateItem');

    Route::post('home/addServices/{token}','ProductionInventoryOperation@addServices');
    Route::post('home/updateServices/{token}','ProductionInventoryOperation@updateServices');

    Route::post('home/addSite/{token}','ProductionMasterOperation@addSite');
  Route::post('home/updateSite/{token}','ProductionMasterOperation@updateSite');

  Route::post('home/addWarehouse/{token}','ProductionMasterOperation@addWarehouse');
  Route::post('home/updateWarehouse/{token}','ProductionMasterOperation@updateWarehouse');

   Route::post('home/addBrand/{token}','ProductionMasterOperation@addBrand');
  Route::post('home/updateBrand/{token}','ProductionMasterOperation@updateBrand');

   Route::post('home/addCategory/{token}','ProductionMasterOperation@addCategory');
  Route::post('home/updateCategory/{token}','ProductionMasterOperation@updateCategory');

  Route::post('home/addItemHSN/{token}','ProductionMasterOperation@addItemHSN');
  Route::post('home/updateItemHSN/{token}','ProductionMasterOperation@updateItemHSN');

   Route::post('home/addServiceSAC/{token}','ProductionMasterOperation@addServiceSAC');
  Route::post('home/updateServiceSAC/{token}','ProductionMasterOperation@updateServiceSAC');
    /*******************************End*************************************************************************/

});
