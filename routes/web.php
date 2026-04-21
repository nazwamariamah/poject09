<?php

use App\Http\Controllers\Admin\AccountManageController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArchiveFileController;
// use App\Http\Controllers\Admin\CabinetController;
// use App\Http\Controllers\Admin\CategoryController;
// use App\Http\Controllers\Admin\FolderController;
use App\Http\Controllers\Admin\FundingSourceController;
use App\Http\Controllers\Admin\PaymentMethodController;
// use App\Http\Controllers\Admin\SearchController;
// use App\Http\Controllers\Admin\AdminDashboardController;
// use App\Http\Controllers\User\UserDashboardController;
// use App\Http\Controllers\Keuangan\KeuanganDashboardController;
// use App\Http\Controllers\Bendahara\BendaharaDashboardController;
use App\Http\Controllers\Bendahara\BendaharaController;
// use App\Http\Controllers\Bendahara\DigitalArchiveController;
use App\Http\Controllers\Keuangan\KeuanganController;
use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\User\PengajuanController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Features\Arsip\Archive\ArchiveController;
use App\Http\Controllers\Features\Arsip\ArsipController;
use App\Http\Controllers\Features\Arsip\Cabinet\CabinetController;
use App\Http\Controllers\Features\Arsip\Category\CategoryController;
use App\Http\Controllers\Features\Arsip\DigitalArchive\DigitalArchiveController;
use App\Http\Controllers\Features\Arsip\Folder\FolderController;
use App\Http\Controllers\Features\Arsip\Rack\RackController;
use App\Http\Controllers\Features\Arsip\SubCategory\SubCategoryController;
use App\Http\Controllers\Features\Arsip\Year\YearController;
use App\Http\Controllers\Features\File_Access\ArchiveFileAccessController;
use App\Http\Controllers\Features\File_Access\FileAccessController;
use App\Http\Controllers\Features\Final_Verification\FinalVerificationController;
use App\Http\Controllers\Features\Final_Verification\SearchFinalVerificationController;
use App\Http\Controllers\Features\Pengajuan\ReturnSubmissionController;
use App\Http\Controllers\Features\Pengajuan\SubmissionController;
use App\Http\Controllers\Features\PPSPM_Verification\PPSPMVerificationController;
use App\Http\Controllers\Features\PPSPM_Verification\SearchPPSPMController;
use App\Http\Controllers\Features\Verifikasi\SearchVerificationController;
use App\Http\Controllers\Features\Verifikasi\VerificationController;
use App\Http\Controllers\Kepala\KepalaController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PPSPM\PPSPMController;
use App\Http\Controllers\User\BudgetSubmissionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'verified')->get('/dashboard', function () {
    $role = Auth::user()->role;
    if ($role == "Admin") {
        return redirect()->route('admin.dashboard');
    } else if ($role == "Keuangan") {
        return redirect()->route('keuangan.dashboard');
    } else if ($role == "Bendahara") {
        return redirect()->route('bendahara.dashboard');
    } else if ($role == "PPSPM") {
        return redirect()->route('PPSPM.dashboard');
    } else if ($role == "Kepala Kantor TVRI") {
        return redirect()->route('kepala.dashboard');
    } else {
        return redirect()->route('user.dashboard');
    }
})->name('dashboard');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/keuangan/dashboard', [KeuanganController::class, 'index'])->name('keuangan.dashboard');
    Route::get('/bendahara/dashboard', [BendaharaController::class, 'index'])->name('bendahara.dashboard');
    Route::get('/ppspm/dashboard', [PPSPMController::class, 'index'])->name('PPSPM.dashboard');
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/kepala/dashboard', [KepalaController::class, 'index'])->name('kepala.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/keuangan/dashboard', [KeuanganController::class, 'index'])->name('keuangan.dashboard');
    Route::get('/bendahara/dashboard', [BendaharaController::class, 'index'])->name('bendahara.dashboard');
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.delete');
    Route::delete('/notifications/read/clear', [NotificationController::class, 'deleteRead'])->name('notifications.deleteRead');
});

require __DIR__ . '/auth.php';



Route::middleware('auth', 'verified')->group(function () {
    // =============================================================== api Submission
    Route::resource("/submit", SubmissionController::class);
    Route::put('/submit/fixing/{id}', [ReturnSubmissionController::class, 'fixing'])->name('submit.fixing');

    // =============================================================== api Verification
    Route::get('/verification/search', [SearchVerificationController::class, 'search'])->name('verification.search');
    Route::resource('/verification', VerificationController::class);

    // =============================================================== api Final Verification
    Route::get('/final/search', [SearchFinalVerificationController::class, 'search'])->name('final.search');
    Route::resource('/final', FinalVerificationController::class);

    // =============================================================== api Verification PPSPM
    Route::get('/validation/search', [SearchPPSPMController::class, 'search'])->name('validation.search');
    Route::put('/validation/return/{id}', [PPSPMVerificationController::class, 'return'])->name('validation.return');
    Route::resource('/validation', PPSPMVerificationController::class);

    // =============================================================== api file access
    Route::get('/file/stream/{id}', [FileAccessController::class, 'stream'])->name('file.stream');
    Route::get('/file/download/{id}', [FileAccessController::class, 'download'])->name('file.download');
    Route::get('/file/metadata/{id}', [FileAccessController::class, 'download_metadata'])->name('file.access.metadata');
    Route::get('/file/stream/digital/{id}', [ArchiveFileAccessController::class, 'stream_digital_archive'])->name('archive.digital.stream');
    Route::get('/file/download/digital/{id}', [ArchiveFileAccessController::class, 'download_digital_archive'])->name('archive.digital.download');
    Route::get('/file/stream/archive/{id}', [ArchiveFileAccessController::class, 'stream_archive'])->name('archive.stream');
    Route::get('/file/download/archive/{id}', [ArchiveFileAccessController::class, 'download_archive'])->name('archive.download');

    // =============================================================== api arsip
    Route::resource('/arsip', ArsipController::class);
    Route::resource('/cabinet', CabinetController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/subcategory', SubCategoryController::class);
    Route::resource('/year', YearController::class);
    Route::resource('/rack', RackController::class);
    Route::resource('/folder', FolderController::class);
    Route::resource('/digital', DigitalArchiveController::class);
    Route::resource('/archive', ArchiveController::class);
});










// =============================================================================================== route tampilan admin
Route::get('/admin/search', [AdminController::class, 'search_archive'])->name('admin.search');

// Route::get('/create/category/{id}', [CategoryController::class, 'create_category_form_cabinet'])->name('category.create');
// Route::get('/list/category/{id}', [CategoryController::class, 'all_list'])->name('category.list');
// Route::delete('/delete/category/{id}', [CategoryController::class, 'destroy_category'])->name('category.delete');
// Route::get('/edit/category/{id}', [CategoryController::class, 'edit_category'])->name('category.edit');
// Route::put('/update/category/{id}', [CategoryController::class, 'update_category'])->name('category.update');

// Route::get('/list/subcategory/{id}', [CategoryController::class, 'create_sub_category'])->name('subcategory.create');
// Route::post('/create/subcategory/{id}', [CategoryController::class, 'add_subcategory'])->name('subcategory.store');
// Route::get('/create/subcategory/{id}', [CategoryController::class, 'sub_category_show'])->name('subcategory.show');
// Route::get('/edit/subcategory/{id}', [CategoryController::class, 'edit_subcategory'])->name('subcategory.edit');
// Route::put('/update/subcategory/{id}', [CategoryController::class, 'update_subcategory'])->name('subcategory.update');
// Route::delete('/delete/subcategory/{id}', [CategoryController::class, 'destroy_subcategory'])->name('subcategory.delete');

// Route::get('/list/year/{id}', [CategoryController::class, 'create_year'])->name('year.create');
// Route::post('/create/year/{id}', [CategoryController::class, 'add_year'])->name('year.store');
// Route::delete('/delete/year/{id}', [CategoryController::class, 'destroy_year'])->name('year.delete');
// Route::get('/edit/year/{id}', [CategoryController::class, 'edit_year'])->name('year.edit');
// Route::put('/update/year/{id}', [CategoryController::class, 'update_year'])->name('year.update');
// Route::get('/list/rack/{id}', [CategoryController::class, 'year_show'])->name('year.show');

// Route::get('/create/rack/{id}', [FolderController::class, 'create_rack'])->name('rack.create');
// Route::post('/add/rack', [FolderController::class, 'add_rack'])->name('rack.store');
// Route::get('/edit/rack/{id}', [FolderController::class, 'edit_rack'])->name('rack.edit');
// Route::put('/update/rack/{id}', [FolderController::class, 'update_rack'])->name('rack.update');
// Route::delete('/delete/rack/{id}', [FolderController::class, 'destroy_rack'])->name('rack.delete');
// Route::get('/list/folder/{id}', [FolderController::class, 'rack_show'])->name('rack.show');

// Route::get('/create/folder/{id}', [FolderController::class, 'create_folder'])->name('folder.create');
// Route::post('/create/folder/{id}', [FolderController::class, 'add_folder'])->name('folder.store');
// Route::get('/edit/folder/{id}', [FolderController::class, 'edit_folder'])->name('folder.edit');
// Route::put('/update/folder/{id}', [FolderController::class, 'update_folder'])->name('folder.update');
// Route::delete('/delete/folder/{id}', [FolderController::class, 'destroy_folder'])->name('folder.delete');

// Route::get('/list/archive/{id}', [FolderController::class, 'folder_show'])->name('archive.list');
Route::get('/input/archive', [AdminController::class, 'input_archive'])->name('admin.archive');
// Route::get('/file/create/{id}', [ArchiveFileController::class, 'create_with_folder'])->name('file.create_with_folder');
// Route::get('/file/download/archive/{id}', [ArchiveFileController::class, 'download_file'])->name('file.download.archive');
// Route::get('/file/{id}', [ArchiveFileController::class, 'name_file'])->name('archive.looks');
// Route::post('/file/upload/{id}', [ArchiveFileController::class, 'update_new_file'])->name('archive.upload.store');

Route::get('/kelola/user', [AdminController::class, 'kelola_user'])->name('admin.kelola');
Route::get('/setting/environment', [AdminController::class, 'environment'])->name('admin.envi');
Route::get('/administrator/report', [AdminController::class, 'report'])->name('admin.report');
Route::get('/administrator/report_account', [AdminController::class, 'report_account_submission'])->name('admin.report_account');
Route::get('/administrator/report_status', [AdminController::class, 'report_count_status'])->name('admin.report_status');

// =================================================================== Route tampilan User
// Route::get('/pengajuan', [UserController::class, 'pengajuan'])->name('user.pengajuan');
Route::get('/user/monitor', [UserController::class, 'worklist'])->name('user.monitoring');

Route::get('/user/report', [UserController::class, 'report'])->name('user.report');
Route::get('/user/report/laporan_pengajuan', [UserController::class, 'report_submission'])->name('laporan.user.pengajuan');
Route::get('/user/report/laporan_pengajuan_nominal', [UserController::class, 'report_submit_nominal'])->name('laporan.user.pengajuan_nominal');


// ==================================================================== Route Keuangan
Route::get('/keuangan/input', [KeuanganController::class, 'input_arsip'])->name('keuangan.input');
// Route::get('/keuangan/check/{id}', [KeuanganController::class, 'check_pengajuan'])->name('keuangan.check'); // diganti verif show
Route::put('/keuangan/update/{id}', [BudgetSubmissionController::class, 'update_check'])->name('keuangan.checkandupate');
// Route::put('/keuangan/perbaiki/{id}', [BudgetSubmissionController::class, 'perbaikan'])->name('keuangan.perbaiki');
// Route::get('/keuangan/pengajuan', [KeuanganController::class, 'all_submit'])->name('keuangan.pengajuan');
// Route::get('/keuangan/search', [KeuanganController::class, 'search_pengajuan'])->name('keuangan.search');
Route::get('/keuangan/report', [KeuanganController::class, 'report'])->name('keuangan.report');
Route::get('/keuangan/report/all_submission', [KeuanganController::class, 'report_all_submission'])->name('keuangan.report.semua_pengajuan');
Route::get('/keuangan/report/verify_submission', [KeuanganController::class, 'report_verification_submission'])->name('keuangan.report.pengajuan_diverifikasi');

// ===================================================================== Route Bendahara
Route::get('/bendahara/sign/{id}', [BendaharaController::class, 'document_sign'])->name('bendahara.sign');
Route::put('/bendahara/verifikasi/{id}', [BudgetSubmissionController::class, 'final_verification'])->name('bendahara.verification');
// Route::get('/archive/pengajuan/{id}', [DigitalArchiveController::class, 'show_in_year'])->name('digital.archive');
// Route::get('/archive/pengajuan/show/{id}', [DigitalArchiveController::class, 'show_digital_archive'])->name('digital.archive.show');
// Route::get('/bendahara/pengajuan', [BendaharaController::class, 'pengajuan'])->name('bendahara.pengajuan');
// Route::get('/bendahara/search', [BendaharaController::class, 'search_pengajuan'])->name('bendahara.search');
Route::get('/bendahara/report', [BendaharaController::class, 'report'])->name('bendahara.report');
Route::get('/bendahara/report_sign', [BendaharaController::class, 'report_sign_submission'])->name('bendahara.report_sign');
Route::get('/bendahara/report_sign_nominal', [BendaharaController::class, 'report_sign_submission_nominal'])->name('bendahara.report_sign_nominal');
Route::get('/bendahara/report_sign_all', [BendaharaController::class, 'report_all_sign_submission'])->name('bendahara.report_sign_all');

// Route::get('/lihat/digital/{id}', [DigitalArchiveController::class, 'name_file'])->name('lihat.digital_archive');
// Route::get('/download/digital/{id}', [DigitalArchiveController::class, 'download_file'])->name('download.digital_archive');


// =================================================================== Route Kepala 
Route::get('/kepala/report', [KepalaController::class, 'report'])->name('kepala.report');
Route::get('/kepala/report_aktif', [KepalaController::class, 'report_aktif'])->name('kepala.report_aktif');
Route::get('/kepala/report_approved', [KepalaController::class, 'report_approved'])->name('kepala.report_approved');

// =================================================================== Route Resource
// Route::resource('/cabinet', CabinetController::class);
// Route::resource('/category', CategoryController::class);
Route::resource('/document/file', ArchiveFileController::class);
// Route::resource('/document/search', SearchController::class);

Route::resource('/account', AccountManageController::class);

Route::resource('/payment', PaymentMethodController::class);
Route::resource('/funding', FundingSourceController::class);

Route::resource('/pengajuan', BudgetSubmissionController::class);
// Route::resource('/archive/digital', DigitalArchiveController::class);

Route::get('register', [RegisteredUserController::class, 'create'])->name('register');

// Route::resource('/digital', DigitalArchiveController::class);

// ======================================================================= costum global
// Route::get('/viewfile/{id}', [BudgetSubmissionController::class, 'lihat_pengajuan'])->name('view.file');
// Route::get('/file/download/{id}', [BudgetSubmissionController::class, 'download_pengajuan'])->name('download.file');
// Route::get('/metadata/download/{id}', [BudgetSubmissionController::class, 'download_metadata_pengajuan'])->name('download.metadata');
