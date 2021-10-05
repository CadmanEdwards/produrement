<?php
Route::redirect('/', 'admin/home');

Auth::routes(['register' => true]);

// Change Password Routes...
Route::view('test', 'test')->name('test');



Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');


Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::delete('permissions_mass_destroy', 'Admin\PermissionsController@massDestroy')->name('permissions.mass_destroy');
    Route::resource('roles', 'Admin\RolesController');
    Route::delete('roles_mass_destroy', 'Admin\RolesController@massDestroy')->name('roles.mass_destroy');
    Route::resource('users', 'Admin\UsersController');
    Route::delete('users_mass_destroy', 'Admin\UsersController@massDestroy')->name('users.mass_destroy');
    Route::resource('seller', 'Admin\SellerController');
    Route::delete('seller_mass_destroy', 'Admin\SellerController@massDestroy')->name('seller.mass_destroy');
    Route::resource('inventory', 'Admin\InventoryController');
    Route::resource('company', 'Admin\CompanyController');
    Route::resource('order', 'Admin\OrderController');
   
});

// Company Routes

Route::get('company/register/{id}', 'Admin\CompanyController@company')->name('company/add');

Route::post('company/register/store', 'Admin\CompanyController@company_register')->name('company.register.store');

Route::post('company/register/update', 'Admin\CompanyController@company_edit_submite')->name('company.register.update');

Route::post('company/unregister/store', 'Auth\BuyerController@company_unregister')->name('company.unregister.store');

Route::post('company/unregister/update', 'Auth\BuyerController@unregister_edit')->name('company.unregister.update');

// Company Routes End



//buyer route





Route::get('request_for_buyer', 'Auth\BuyerController@request_for_buyer')->name('request_for_buyer');
Route::post('edit_user_data', 'Auth\BuyerController@edit_user_data')->name('edit_user_data');
Route::get('buyer_list', 'Auth\BuyerController@buyer_list')->name('buyer_list');
Route::get('admin_buyer_list', 'Auth\BuyerController@admin_buyer_list')->name('admin_buyer_list');
Route::get('admin_seller_list', 'Auth\BuyerController@admin_seller_list')->name('admin_seller_list');
Route::get('company_list', 'Auth\BuyerController@company_list')->name('company_list');
Route::get('Buyer/login', 'Auth\BuyerController@login')->name('Buyer/login');
Route::get('Buyer/view/details/{id}', 'Auth\BuyerController@view_buyer_details')->name('view/buyer/details');
Route::get('Seller/view/details/{id}', 'Auth\BuyerController@view_seller_details')->name('view/seller/details');
Route::get('Buyer/forgot_password', 'Auth\BuyerController@forgot_password')->name('Buyer/forgot_password');
Route::get('Buyer/register', 'Auth\BuyerController@register')->name('Buyer/register');
Route::get('interest/register/{id}', 'Auth\BuyerController@interest')->name('interest/add');
Route::get('company/edit/{id}', 'Auth\BuyerController@company_edit')->name('company/edit_view');
Route::get('company/fieldofinterset/edit/{id}', 'Auth\BuyerController@field_of_interest_edit')->name('company/fieldofinterset/edit_view');
Route::post('Buyer/login_check', 'Auth\BuyerController@login_check')->name('Buyer/login_check');


Route::post('company/intrest/submite', 'Auth\BuyerController@company_interest_add')->name('company/intrest/submite');
Route::post('company/verification/submite', 'Auth\BuyerController@company_verification_add')->name('company/verification/submite');
Route::post('company/intrest/edit/submite', 'Auth\BuyerController@company_interest_edit_submit')->name('company/intrest/edit/submite');
Route::post('seller/intrest/submite', 'Auth\BuyerController@seller_interest_add')->name('seller/intrest/submite');

Route::post('register_buyer_submit', 'Auth\BuyerController@register_buyer_submit')->name('register_buyer_submit');

Route::post('register_seller_submit', 'Auth\RegisterController@register_seller_submit')->name('register_seller_submit');

Route::post('agent_assign_change', 'Auth\BuyerController@agent_assign_change')->name('agent_assign_change');
Route::get('create/buyer/{id}', 'Auth\RegisterController@create_buyer')->name('create/redirect');
Route::post('/insert_session_id', 'Auth\BuyerController@insert_session_id')->name('insert_session_id');
Route::post('/insert_relation', 'Auth\BuyerController@insert_relation')->name('insert_relation');
Route::post('/show_modal_company', 'Auth\BuyerController@show_modal_company')->name('show_modal_company');
Route::post('/show_modal_payment', 'Auth\BuyerController@show_modal_payment')->name('show_modal_payment');
Route::post('/show_inner_modal_html_company', 'Auth\BuyerController@show_inner_modal_html_company')->name('show_inner_modal_html_company');
Route::post('/show_inner_modal_html_company_seller', 'Auth\BuyerController@show_inner_modal_html_company_seller')->name('show_inner_modal_html_company_seller');
Route::post('/block_user', 'Auth\BuyerController@block_user')->name('block_user');
Route::post('/unblock_block_user', 'Auth\BuyerController@unblock_block_user')->name('unblock_block_user');
Route::post('/show_inner_modal_html_company_buyer', 'Auth\BuyerController@show_inner_modal_html_company_buyer')->name('show_inner_modal_html_company_buyer');
Route::post('/count_buyer_request', 'Auth\BuyerController@count_buyer_request')->name('count_buyer_request');
Route::post('/active_inventory', 'Auth\BuyerController@active_inventory')->name('active_inventory');
Route::post('/deactive_inventory', 'Auth\BuyerController@deactive_inventory')->name('deactive_inventory');
Route::post('/status_update_realation', 'Auth\BuyerController@status_update_realation')->name('status_update_realation');
Route::post('/status_reject_realation', 'Auth\BuyerController@status_reject_realation')->name('status_reject_realation');
Route::get('company/store/{id}', 'Auth\BuyerController@view_store')->name('company/view_store');
Route::get('company/cart/{id}', 'Auth\BuyerController@view_cart')->name('company/view_cart');
Route::get('company/verify/account/{id}', 'Auth\BuyerController@company_verify_account')->name('company/verify/sales_agent');
Route::get('cnic/verification/seller/{id}', 'Auth\BuyerController@cnic_verification')->name('cnic/verification');
Route::post('/get_cart_data', 'Auth\BuyerController@get_cart_data')->name('get_cart_data');
Route::post('create/order/submite', 'Auth\BuyerController@create_order')->name('create/order/submite');
Route::get('delivered_order', 'Admin\OrderController@delivered_order')->name('delivered_order');
Route::get('completed_order', 'Admin\OrderController@complete_order')->name('completed_order');
Route::get('rejected_order', 'Admin\OrderController@rejected_order')->name('rejected_order');
Route::get('invoice_order', 'Admin\OrderController@invoice_order')->name('invoice_order');
Route::get('view/cart/{id}', 'Admin\OrderController@view_cart_details')->name('view/order');
Route::get('download/invoice/{id}', 'Admin\OrderController@download_invoice_pdf')->name('download/PDF');
Route::get('download/payment/invoice/{id}', 'Admin\OrderController@download_payment_invoice_pdf')->name('download/payment/PDF');
Route::get('view/pending/{id}', 'Admin\OrderController@view_pending_order_details')->name('view/pending/orders');
Route::get('view/invoice/{id}', 'Admin\OrderController@view_invoice_order_details')->name('view/invoice/orders');
Route::get('view/partial/invoice/{id}', 'Admin\OrderController@view_partial_invoice_order_details')->name('view/partial/invoice/orders');
Route::get('view/complete/invoice/{id}', 'Admin\OrderController@view_complete_orders')->name('view/complete/orders');
Route::post('change/status/recive_items', 'Admin\OrderController@change_status_recive_items')->name('change/status/recive_items');
Route::post('create/invoice/for_buyers', 'Admin\OrderController@create_invoice_for_buyer')->name('create/invoice/for_buyer');
Route::post('create/order/invoice', 'Admin\OrderController@create_order_invoice')->name('create/order/invoice');
Route::post('change/status/half/recive_items', 'Admin\OrderController@change_status_half_recive_items')->name('change/status/half/recive_items');
Route::post('payment/add/invoice', 'Admin\OrderController@payment_add')->name('payment/add/invoice');
Route::post('payment/partial/add/invoice', 'Admin\OrderController@payment_partial_add')->name('payment/partial/add/invoice');

Route::post('export/submit', 'Admin\InventoryController@export_submit')->name('export/submit');

Route::post('category_add', 'Admin\InventoryController@category_add')->name('category_add');
Route::get('admin.inventory.export', 'Admin\InventoryController@export')->name('admin.inventory.export');
Route::post('sku_add', 'Admin\InventoryController@sku_add')->name('sku_add');
Route::post('inventory_edit_submit', 'Admin\InventoryController@inventory_edit_submit')->name('inventory_edit_submit');
Route::get('admin.Inventory.edit/{id}', 'Admin\InventoryController@edit')->name('admin.Inventory.edit');
Route::post('password_reset', 'Admin\UsersController@password_reset')->name('password_reset');
Route::post('password_change_with_front', 'Admin\UsersController@password_change_with_front')->name('password_change_with_front');
Route::get('reset_password', 'Admin\UsersController@reset_password')->name('reset_password');

Route::get('csv', 'CsvController@index')->name('csv'); // localhost:8000/
Route::post('/uploadFile', 'CsvController@uploadFile');
Route::post('/copy_inventory_for_inventory', 'Auth\BuyerController@copy_inventory_for_inventory');

// sales agent routes //
Route::get('sales/agent', 'Admin\SellerController@sales_agent')->name('sales/agent');
Route::get('seller/agent/create', 'Admin\SellerController@sale_agent_create')->name('seller/agent/create');
Route::post('seller/agent/submit', 'Admin\SellerController@sale_agent_submit')->name('seller/agent/submit');
Route::post('seller/agent/edit/submit', 'Admin\SellerController@sale_agent_edit_submit')->name('seller/agent/edit/submit');
Route::get('seller/agent/edit/{id}', 'Admin\SellerController@edit_seller')->name('seller/agent/edit');
Route::delete('seller/agent/destroy/{id}', 'Admin\SellerController@agentDestroy')->name('seller/agent/destroy');

// sales manage buyer //
Route::get('sales/agent/buyer', 'Admin\SellerController@view_buyer')->name('sales/agent/buyer');
Route::get('sales/agent/pdf_view', 'Admin\SellerController@pdf_view')->name('sales/agent/pdf/view');
Route::get('sales/agent/order', 'Admin\SellerController@view_order')->name('sales/agent/order');
Route::get('sales/agent/completed_order', 'Admin\SellerController@complete_order')->name('sales/agent/completed_order');
Route::get('sales/agent/rejected_order', 'Admin\SellerController@rejected_order')->name('sales/agent/rejected_order');
Route::get('sales/agent/invoice_order', 'Admin\SellerController@invoice_order')->name('sales/agent/invoice_order');
Route::get('sales/agent/delivered_order', 'Admin\SellerController@delivered_order')->name('sales/agent/delivered_order');
Route::get('sales/agent/view/{id}', 'Admin\SellerController@view_pending_order_details')->name('sales/agent/view_pending_order');

Route::get('sales/agent/pdf/{id}', 'Admin\SellerController@downloadDeliveryInvoice')->name('downloadDeliveryInvoice');

Route::get('sales/agent/view/reject/order/view/{id}', 'Admin\SellerController@view_rejected_order_details')->name('sales/agent/view_rejected_order');
Route::get('sales/agent/view/partially/{id}', 'Admin\SellerController@view_partially_order_details')->name('sales/agent/view_partially_order');
Route::get('sales/agent/invoice/view/{id}', 'Admin\SellerController@view_invoice_order_details')->name('sales/agent/view_invoice_order');
Route::get('sales/agent/invoice/view/{id}', 'Admin\SellerController@view_invoice_order_details')->name('sales/agent/view_invoice_order');
Route::get('sales/agent/complete_view/{id}', 'Admin\SellerController@view_complete_orders_details')->name('sales/agent/view_complete_orders_details');
Route::get('sales/agent/view/cart/{id}', 'Admin\SellerController@view_cart_details')->name('sales/agent/view/order');
Route::get('view/cart/half/order/{id}', 'Admin\SellerController@view_cart_half_order')->name('view/order/order/half');


Route::get('agreement/list', 'Admin\SellerController@agreement_list')->name('agreement/list');
Route::get('sales/agent/agreement', 'Admin\SellerController@sale_agent_agreement')->name('sales/agent/agreement');
Route::post('agreement/submit', 'Admin\SellerController@agreement_submit')->name('agreement/submit');

Route::view('sti', 'pdf.sales_tax_invoice_pdf');
Route::view('invoice_ledger_1', 'pdf.invoice_ledger_1');
Route::view('invoice_ledger_2', 'pdf.invoice_ledger_2');
Route::view('payment_pop_out', 'pdf.payment_pop_out');
Route::view('statement_of_account', 'pdf.statement_of_account');