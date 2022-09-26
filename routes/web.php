<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\CronController;
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

Route::get('/', [IndexController::class,'index'] );
Route::get('index', [IndexController::class,'index'] )->name('index');
Route::get('faq', [IndexController::class,'faq'] )->name('faq');
Route::get('forgot-password', [IndexController::class,'forgotPassword'] )->name('forgot-password');
Route::post('forgotPassword_2', [IndexController::class,'forgotPassword_2'] )->name('forgotPassword_2');
Route::post('getFullname', [IndexController::class,'getFullname'] )->name('getFullname');


Route::get('logout', [IndexController::class,'logout'] )->name('logout');
Route::get('login', [IndexController::class,'login'] )->name('login');
Route::get('register/{registerId?}', [IndexController::class,'register'] )->name('register');
Route::post('registerFrm', [IndexController::class,'registerFrm'] )->name('registerFrm');
Route::post('loginIn', [IndexController::class,'loginIn'] )->name('loginIn');

////Profile
Route::post('saveProfile', [ProfileController::class,'saveProfile'] )->name('saveProfile')->middleware('auth');
Route::post('saveWalletAddressErc20', [ProfileController::class,'saveWalletAddressErc20'] )->name('saveWalletAddressErc20')->middleware('auth');

Route::post('saveWalletAddressTrc20', [ProfileController::class,'saveWalletAddressTrc20'] )->name('saveWalletAddressTrc20')->middleware('auth');

Route::post('saveWalletAddressBep20', [ProfileController::class,'saveWalletAddressBep20'] )->name('saveWalletAddressBep20')->middleware('auth');

Route::post('changePassword', [ProfileController::class,'changePassword'] )->name('changePassword')->middleware('auth');
Route::post('saveBank', [ProfileController::class,'saveBank'] )->name('saveBank')->middleware('auth');
Route::get('account', [ProfileController::class,'account'] )->name('account')->middleware('auth');
Route::get('userlist', [ProfileController::class,'userlist'] )->name('userlist')->middleware('auth');
Route::get('package-history', [ProfileController::class,'packageHistory'] )->name('package-history');
Route::get('package-report', [ProfileController::class,'packageReport'] )->name('package-report');
Route::get('levelIncome', [ProfileController::class,'levelIncome'] )->name('levelIncome');
Route::get('rankIncome', [ProfileController::class,'rankIncome'] )->name('rankIncome');
Route::get('referralIncome', [ProfileController::class,'referralIncome'] )->name('referralIncome');
Route::get('stakIncome', [ProfileController::class,'stakIncome'] )->name('stakIncome');
Route::get('level-report', [ProfileController::class,'levelReport'] )->name('level-report');
Route::get('referral-report', [ProfileController::class,'referralReport'] )->name('referral-report');
Route::get('rank-report', [ProfileController::class,'rankReport'] )->name('rank-report');
Route::post('get-team-info', [ProfileController::class,'getTeamInfo'] )->name('get-team-info');
Route::get('network', [ProfileController::class,'network'] )->name('network')->middleware('auth');
///Package Routes



Route::post('investPackage', [DashboardController::class,'investPackage'] )->name('investPackage');
/////cron 
Route::get('wazirxCron', [CronController::class,'wazirxCron'] )->name('wazirxCron');
Route::get('roiCron', [CronController::class,'roiCron'] )->name('roiCron');
Route::get('correctLevelCount', [CronController::class,'correctLevelCount'] )->name('correctLevelCount');
Route::get('packageamt', [CronController::class,'packageamt'] )->name('packageamt');
Route::get('fastBonusCron', [CronController::class,'fastBonusCron'] )->name('fastBonusCron');
Route::get('rewardCron', [CronController::class,'rewardCron'] )->name('rewardCron');
Route::get('priceCron', [CronController::class,'priceCron'] )->name('priceCron');









Route::post('saveNewslatter', [IndexController::class,'saveNewslatter'] )->name('saveNewslatter');






///staking
Route::post('getCurrencyprice', [DashboardController::class,'getCurrencyprice'] )->name('getCurrencyprice')->middleware('auth');
Route::post('stakeNow', [DashboardController::class,'stakeNow'] )->name('stakeNow')->middleware('auth');
Route::post('withdrawal', [DashboardController::class,'withdrawal'] )->name('withdrawal')->middleware('auth');
Route::post('withdrawalapprove', [DashboardController::class,'withdrawalapprove'] )->name('withdrawalapprove')->middleware('auth');
Route::post('withdrawalrequest', [DashboardController::class,'withdrawalrequest'] )->name('withdrawalrequest')->middleware('auth');
Route::post('saveaddress', [DashboardController::class,'saveaddress'] )->name('saveaddress')->middleware('auth');
Route::get('unStake/{id}', [DashboardController::class,'unStake'] )->name('unStake')->middleware('auth');


Route::get('deposit', [DepositController::class,'deposit'] )->name('deposit')->middleware('auth');
Route::post('saveDeposit', [DepositController::class,'saveDeposit'] )->name('saveDeposit')->middleware('auth');
Route::get('failedDeposit/{id}', [DepositController::class,'failedDeposit'] )->name('failedDeposit')->middleware('auth');


Route::get('dashboard', [DashboardController::class,'dashboard'] )->name('dashboard')->middleware('auth');

Route::post('ipnurl', [IndexController::class,'ipnurl'] )->name('ipnurl');
Route::get('coinpaysuccess', [DashboardController::class,'coinpaysuccess'] )->name('coinpaysuccess');
Route::get('coinpayfail', [DashboardController::class,'coinpayfail'] )->name('coinpayfail');


Route::get('wallet-history', [DashboardController::class,'walletHistory'] )->name('wallet-history')->middleware('auth');
Route::get('wallet', [DashboardController::class,'wallet'] )->name('wallet')->middleware('auth');
Route::get('withdrawalreq', [DashboardController::class,'withdrawalreq'] )->name('withdrawalreq')->middleware('auth');
Route::get('withdraw-history', [ProfileController::class,'withdrawHistory'] )->name('withdraw-history')->middleware('auth');
Route::post('saveBankDetails', [DashboardController::class,'saveBankDetails'] )->name('saveBankDetails')->middleware('auth');
Route::post('utrRequestSave', [DashboardController::class,'utrRequestSave'] )->name('utrRequestSave')->middleware('auth');
Route::get('stake', [DashboardController::class,'stake'] )->name('stake')->middleware('auth');
Route::get('inr-deposit-request', [DashboardController::class,'inrDepositRequest'] )->name('inr-deposit-request')->middleware('auth');
Route::get('inr-deposit-request', [DashboardController::class,'inrDepositRequest'] )->name('inr-deposit-request')->middleware('auth');
Route::get('actionINRrequest/{val}/{id}', [DashboardController::class,'actionINRrequest'] )->name('actionINRrequest')->middleware('auth');

Route::get('referral-income', [DashboardController::class,'referralIncome'] )->name('referral-income')->middleware('auth');
Route::get('referral-team', [DashboardController::class,'referralTeam'] )->name('referral-team')->middleware('auth');
Route::get('staking-history', [DashboardController::class,'stakingHistory'] )->name('staking-history')->middleware('auth');


Route::get('price-manager', [DashboardController::class,'priceManager'] )->name('price-manager')->middleware('auth');
Route::post('savePrice', [DashboardController::class,'savePrice'] )->name('savePrice')->middleware('auth');

/*******************Subscription ******************************/
Route::post('subscriptionRequest', [SubscriptionController::class,'subscriptionRequest'] )->name('subscriptionRequest');