<?php
header("Access-Control-Allow-Origin: *");
require_once 'dbconfig.php';

$db_data = array();

$action = $_POST['action'];
include_once 'sections/services/category.php';
include_once 'sections/services/sub-category.php';
include_once 'sections/accounting/expense-category.php';
include_once 'sections/accounting/expense-sub-category.php';
include_once 'sections/accounting/expenses.php';
include_once 'sections/accounting/income-category.php';
include_once 'sections/accounting/income-sub-category.php';
include_once 'sections/accounting/income-sub-category.php';
include_once 'sections/accounting/income.php';
include_once 'sections/customer/customer.php';
include_once 'sections/sms/api.php';
include_once 'sections/sms/sms.php';
include_once 'sections/services/service.php';
include_once 'sections/accounts/users.php';
include_once 'sections/accounts/role.php';
include_once 'sections/company/company.php';
include_once 'sections/branch/branches.php';
include_once 'sections/pos/sales.php';
include_once 'sections/cashflow/cashflow-report.php';
include_once 'sections/cashflow/cashflow-report-year.php';
include_once 'sections/dashboard/dashboard.php';
?>