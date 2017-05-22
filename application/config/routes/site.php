<?php

/* ===============================================================
                     SITE ROUTES START
================================================================= */

/*--- Pages Start ---*/

$route['about'] = 'PagesController/about';
$route['overview'] = 'PagesController/overview';
$route['how-it-works'] = 'PagesController/howItWorks';
$route['need-help'] = 'PagesController/needHelp';
$route['questions'] = 'PagesController/questions';
$route['expert/(:num)'] = 'PagesController/getOneExpertById/$1';
$route['specialize/(:any)'] = 'PagesController/specializeExperts/$1';

/*--- Pages End ---*/


/*--- User(Client and Expert) Start ---*/


$route['getPaymentClient'] = 'Site/UserController/getPaymentClient';
$route['get-expert-chat-price'] = 'Site/UserController/getExpertChatPrice';
$route['set-payment'] = 'Site/UserController/setPayment';
$route['logout'] = 'Site/UserController/logout';
$route['register/client'] = 'Site/UserController/registerClient';
$route['register/expert'] = 'Site/UserController/registerExpert';
$route['login'] = 'Site/UserController/login';

// -- -- -- -- -- -- -- -- --

$route['reading-history'] = 'Site/UserDashboardController/readingHistory';
$route['reading-history/chat/(:num)'] = 'Site/UserDashboardController/oneHistory/chat/$1';
$route['reading-history/message/(:num)/(:any)'] = 'Site/UserDashboardController/oneHistory/message/$1/$2';
$route['reading-history/ajax'] = 'Site/UserDashboardController/viewMore';
$route['message/reply/(:num)'] = 'Site/UserDashboardController/messageReply/$1';
$route['settings'] = 'Site/UserDashboardController/userSettingsView';
$route['dashboard'] = 'Site/UserDashboardController/dashboard';
$route['payment_success'] = 'Site/UserDashboardController/paymentSuccess';
$route['edit-settings'] = 'Site/UserDashboardController/userPersonalSettings';
$route['tel-number'] = 'Site/UserDashboardController/userPhoneNumber';
$route['payments'] = 'Site/UserDashboardController/paymentsView';

$route['load-messages'] = 'Site/UserDashboardController/loadMessages';
$route['load-chatdetails'] = 'Site/UserDashboardController/loadChatDetails';

/*--- User(Client and Expert) End ---*/


/*--- Client Dashboard Start ---*/

$route['expert/favorite'] = 'Site/Client/ClientsController/addFavoriteList';
$route['expert/favorite/del'] = 'Site/Client/ClientsController/deleteFavoriteList';
$route['message/expert/(:num)'] = 'Site/Client/ClientsController/clientMessage/$1';
$route['payInvoice'] = 'Site/Client/ClientsController/payInvoice';
$route['stars'] = 'Site/Client/ClientsController/stars';
$route['blockExpert'] = 'Site/Client/ClientsController/blockExpert';
//$route['client/messages/answer/(:num)'] = 'Site/Client/ClientsController/clientMessagesAnswer/$1';


// -- -- -- -- -- -- -- -- --

$route['favorite-list'] = 'Site/Client/ClientDashboardController/clientFavoriteList';
$route['client/messages'] = 'Site/Client/ClientDashboardController/expertsList';
$route['client/messages/show/(:num)/(:any)'] = 'Site/Client/ClientDashboardController/messagesList/$1/$2';
$route['client/messages/delete'] = 'Site/Client/ClientDashboardController/deleteMessages';
$route['dashboard/payments/search'] = 'Site/Client/ClientDashboardController/paymentSearch';

/*--- Client Dashboard End ---*/



/*--- Expert Dashboard Start ---*/

$route['load_wdform'] = 'Site/Expert/ExpertsController/loadWithdrawform';
$route['withdraw'] = 'Site/Expert/ExpertsController/withdrawBalance';

$route['freeMessage'] = 'Site/Expert/ExpertsController/freeMessage';
$route['expert/messages/answer/(:num)'] = 'Site/Expert/ExpertsController/expertMessagesAnswer/$1';
$route['dashboard/expert/payments/search'] = 'Site/Expert/ExpertsController/paymentSearch';
$route['expert/messages/delete'] = 'Site/Expert/ExpertsController/deleteMessages';
$route['block-client'] = 'Site/Expert/ExpertsController/blockClient';
$route['charge-client'] = 'Site/Expert/ExpertsController/chargeClient';
$route['feedback-more'] = 'Site/Expert/ExpertsController/getFeedbackMore';
$route['expert-more'] = 'Site/Expert/ExpertsController/getExpertsMore';
$route['update-client'] = 'Site/Expert/ExpertsController/updateMyClients';

$route['send-invoice'] = 'Site/Expert/ExpertsController/sendInvoice';

// -- -- -- -- -- -- -- -- -- --
$route['expert/messages/show/(:num)/(:any)'] = 'Site/Expert/ExpertDashboardController/messages/$1/$2';
$route['expert/chat/show/(:num)'] = 'Site/Expert/ExpertDashboardController/chat/$1';

$route['skills-experience'] = 'Site/Expert/ExpertDashboardController/expertSkillView';
$route['expert/messages'] = 'Site/Expert/ExpertDashboardController/messageList';
$route['chat-price'] = 'Site/Expert/ExpertDashboardController/chatPriceChange';
$route['expert-status'] = 'Site/Expert/ExpertDashboardController/expertStatusChange';

$route['expert/invoices'] = 'Site/Expert/ExpertDashboardController/Invoices';

/*--- Expert Dashboard End ---*/






$route['confirm'] = 'HomeController/confirm';
$route['paypal'] = 'HomeController/paypal';


$route['save-chat'] = 'Site/UserController/saveChat';
$route['get-chat'] = 'Site/UserController/getChat';



