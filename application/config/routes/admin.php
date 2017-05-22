<?php

$route['admin'] = 'Admin/AdminController/index';
$route['admin/login'] = 'Admin/AdminController/login';
$route['admin/logout'] = 'Admin/AdminController/logout';
$route['admin/dashboard'] = 'Admin/AdminController/dashboard';
$route['admin/configuration'] = 'Admin/AdminController/configuration';

/* Client Start */

$route['admin/clients'] = 'Admin/Client/ClientController/clientView';
$route['admin/clients/edit/(:num)'] = 'Admin/Client/ClientController/editClientView/$1';
$route['admin/clients/show/(:num)'] = 'Admin/Client/ClientController/showClientView/$1';
$route['admin/clients/notActive'] = 'Admin/Client/ClientController/notActiveClientView';

/* Client End */

/* Expert Start */

$route['admin/experts'] = 'Admin/Expert/ExpertController/expertView';
$route['admin/experts/(:num)'] = 'Admin/Expert/ExpertController/expertView/$1';
$route['admin/experts/activation'] = 'Admin/Expert/ExpertController/expertActivationView';
$route['admin/experts/edit/(:num)'] = 'Admin/Expert/ExpertController/editExpertView/$1';
$route['admin/experts/show/(:num)'] = 'Admin/Expert/ExpertController/showExpertView/$1';

/* Expert End */

$route['admin/deleteUser'] = 'Admin/AdminController/delete_user';
$route['admin/categories/create'] = 'Admin/Expert/ExpertController/createExpertCategoriesView';
$route['admin/categories/all'] = 'Admin/Expert/ExpertController/allExpertCategories';
$route['admin/categories/edit/(:num)'] = 'Admin/Expert/ExpertController/editExpertCategoriesView/$1';
$route['admin/categories/delete'] = 'Admin/Expert/ExpertController/deleteExpertCategories';

$route['admin/expert_ranking'] = 'Admin/Expert/ExpertController/expertRanking';
$route['admin/expert_ranking/(:num)'] = 'Admin/Expert/ExpertController/expertRanking/$1';

$route['admin/payments'] = 'Admin/AdminController/Payments';
$route['admin/payments/(:num)/(:num)'] = 'Admin/AdminController/Payments/$1/$2';
$route['admin/payment_details/(:any)/(:num)'] = 'Admin/AdminController/PaymentView/$1/$2';
$route['admin/payment-process/(:num)'] = 'Admin/AdminController/PaymentsProcessOne/$1';
$route['admin/payments/send'] = 'Admin/AdminController/PaymentsSend';
$route['admin/payments/withdrawals'] = 'Admin/AdminController/Withdrawals';
$route['admin/payments/withdrawal/(:any)/(:num)'] = 'Admin/AdminController/WithdrawalAction/$1/$2';
$route['admin/admin/confirm'] = 'Admin/AdminController/PaymentsConfirm';

$route['admin/reading-history/(:any)/(:num)'] = 'Admin/AdminController/ReadingHistory/$1/$2';
$route['admin/reading-history/(:any)'] = 'Admin/AdminController/ReadingHistory/$1';

$route['admin/ajax/(:any)'] = 'Admin/AdminController/HandleAjax/$1';
