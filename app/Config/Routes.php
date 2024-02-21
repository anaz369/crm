<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
$routes->get('stockreport', 'Home::stockreport');
$routes->get('dashboard', 'Home::dashboard');
$routes->post('search', 'Home::search');
$routes->get('createlead', 'Home::create_lead');
$routes->get('createuser', 'Home::create_user');
$routes->post('createuser', 'Home::create_user');
$routes->post('createlead', 'Home::create_lead');
$routes->get('newlead', 'Home::new_lead');
$routes->post('new_lead_update', 'Home::new_lead');

$routes->get('edit-lead/(:any)', 'Home::edit_lead/$1/$1');
$routes->post('edit-lead/(:num)', 'Home::edit_lead/$1');

$routes->get('delete/(:num)', 'Home::delete_newleads/$1');
$routes->get('delete_responded/(:num)', 'Home::delete_responded/$1');
$routes->get('respondedlead', 'Home::responded_lead');
$routes->post('respondedlead', 'Home::responded_lead');
$routes->post('responded_update', 'Home::responded_lead');
$routes->post('responded_edit', 'Home::responded_edit');
$routes->get('notrespondedlead', 'Home::not_responded_lead');
$routes->post('notresponded_update', 'Home::not_responded_lead');
$routes->post('notresponded_edit', 'Home::not_responded_edit');
$routes->get('delete_notresponded_lead/(:num)', 'Home::delete_not_responded_lead/$1');
$routes->get('demo-assigned', 'Home::demo_assigned');
$routes->post('demo_assigned_update', 'Home::demo_assigned');
$routes->post('demoassigned_edit', 'Home::demo_assigned_edit');
$routes->get('delete_demo_assigned/(:num)', 'Home::delete_demo_assigned/$1');
$routes->get('demo-completed', 'Home::demo_completed');
$routes->get('delete_democompleted/(:num)', 'Home::delete_democompleted/$1');
$routes->get('delete_demo_aborted/(:num)', 'Home::delete_demo_aborted/$1');
$routes->post('demo_complete_update', 'Home::demo_completed');
$routes->get('update-lead', 'Home::update_lead');
$routes->get('edit-lead', 'Home::edit_lead');
$routes->get('demo-aborted', 'Home::demo_aborted');
$routes->post('new_lead_abort', 'Home::lead_abort');

$routes->post('demo-aborted', 'Home::demo_aborted');

$routes->get('payment-received', 'Home::payment_received');
$routes->post('payment_received_update', 'Home::payment_received');
$routes->get('delete-payment-received/(:num)', 'Home::delete_payment_received/$1');
$routes->get('delivered-leads', 'Home::delivered_leads');
$routes->get('delete-delivery-received/(:num)', 'Home::delete_delivery_received/$1');
$routes->get('viewall-leads', 'Home::viewall_leads');
$routes->get('delete_all_lead/(:num)', 'Home::delete_all_lead/$1');
$routes->post('viewall-leads', 'Home::viewall_leads');
$routes->get('view-more/(:num)', 'Home::view_more/$1');
$routes->post('democompleted_edit', 'Home::demo_completed_edit');
$routes->get('home/individual_payment', 'Home::individual_payment');
$routes->get('home/remarks', 'Home::remarks');
$routes->post('deliveredleads_edit', 'Home::deliveredleads_edit');
$routes->post('addindustrytype', 'Home::addindustry');
$routes->post('addreseller', 'Home::addreseller');
$routes->post('addleadsourceform', 'Home::addleadsourceform');
$routes->post('editpayment', 'Home::editpayment');
$routes->post('addpayment', 'Home::addpayment');
$routes->get('edit-user/(:num)', 'Home::edit_user/$1');
$routes->post('edit-user/(:num)', 'Home::edit_user/$1');
$routes->get('delete_listuser/(:num)', 'Home::delete_list_user/$1');
$routes->get('listuser', 'Home::list_user');
$routes->get('change-pass/(:num)', 'Home::change_password/$1');
$routes->post('change-pass/(:num)', 'Home::change_password/$1');
$routes->get('report', 'Home::report');
$routes->get('country_report', 'Home::country_report');
$routes->get('month_report', 'Home::month_report');
$routes->get('presented_report', 'Home::presented_report');
$routes->get('timeslot', 'Home::timeslot');
$routes->post('noslot', 'Home::noslot');
$routes->get('ticket', 'Home::ticket');
$routes->post('ticket', 'Home::ticket');
$routes->get('new-tickets', 'Home::new_ticket');
$routes->post('new-tickets', 'Home::new_ticket');
$routes->get('new-ticket', 'Home::new_ticket1');
$routes->post('new-ticket', 'Home::new_ticket1');
$routes->get('active-tickets', 'Home::active_ticket');
$routes->get('list_ticket', 'Home::list_ticket');
$routes->get('view-tickets/(:num)', 'Home::view_tickets/$1');
$routes->get('ticket_followup/(:any)/(:num)', 'Home::ticket_followup/$1/$2');
$routes->get('ticket-details/(:any)/(:num)', 'Home::ticket_details/$1/$2');

$routes->post('ticket_followup/(:any)/(:num)', 'Home::ticket_followup/$1/$2');
$routes->post('ticket_followup/(:any)/close-ticket', 'Home::closed_tickets');
$routes->get('closed-tickets', 'Home::closed_tickets');
$routes->post('change-cuspass', 'Home::change_customerPassword');
$routes->get('change-cuspass', 'Home::change_customerPassword');
$routes->post('block-user', 'Home::block_user');
$routes->get('/', 'Home::login');
$routes->post('/', 'Home::login');
$routes->get('logout', 'Home::logout');
$routes->get('/passwordchange', 'Home::change_passwordnew');
 $routes->post('/passwordchange', 'Home::change_passwordnew');

$routes->post('update-priority', 'Home::priority'); 
$routes->get('prioritized-leads', 'Home::priority_leads');

$routes->get('offer-mailsent', 'Home::offermail_sent');
$routes->get('invoice-sent', 'Home::invoice_sent');
$routes->get('userwise_report', 'Home::userwise_report');
$routes->get('trial-account', 'Home::trial_account_sent');
$routes->get('demo-video', 'Home::demo_video_sent');
$routes->get('lost-leads', 'Home::lost_leads');
$routes->get('viewdaily-leads', 'Home::viewDaily_leads');

$routes->get('payment_report', 'Home::payment_report');
$routes->get('view-paymentdetails/(:segment)/', 'Home::view_paymentdetails/$1');

$routes->get('update-status', 'Home::update_status');

$routes->get('edit-newlead/(:num)', 'Home::edit_newlead/$1');
$routes->post('edit-newlead/(:num)', 'Home::edit_newlead/$1');
$routes->post('lead-transfer', 'Home::lead_transfer');
$routes->get('export-report', 'Home::export_report');
$routes->post('export-report', 'Home::export_report');

$routes->get('detail-report/(:num)', 'Home::detail_demowise_report/$1');

$routes->get('export-excel', 'Home::exportToCsv');

$routes->post('client-call', 'Home::client_callUpdate');

$routes->get('call-details', 'Home::call_details');

$routes->get('support-team','Home::support_team');
$routes->get('campaign-list','Home::campaign_list');

$routes->get('campaign-details/(:num)','Home::campaign_detail_list/$1');
$routes->get('client-list/(:num)', 'Home::select_client_list/$1');
// $routes->get('client-list/(:num)/(:any)', 'Home::select_client_list/$1/$2');
