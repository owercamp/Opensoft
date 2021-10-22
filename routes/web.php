<?php

use App\Http\Controllers\SGOperativeController;

Route::get('/', function () {
  return view('auth.login');
})->middleware('guest');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test_bj', function () {
  return view('test');
})->name('test');

// <span><a href="#" title="DESCRIPCION DE AYUDA"><i class="fas fa-question-circle"></i></a></span>

/*-----------------------------------------
MODULES ADMINISTRATIVE'S ROUTES
------------------------------------------*/

// RUTAS DEL MODULO DE CONFIGURACION
Route::group(['middleware' => ['role:ADMINISTRADOR SISTEMA|ADMINISTRADOR']], function () {

  // CONFIGURACION >> ACCESO

  // Roles
  Route::get('/setting/access/roles', 'AccessController@rolesTo')->name('access.roles');
  // Permisos
  Route::get('/setting/access/permissions', 'AccessController@permissionsTo')->name('access.permissions');
  // Usuarios
  Route::get('/setting/access/users', 'AccessController@usersTo')->name('access.users');

  // CONFIGURACION >> LUGARES

  // Departamentos
  Route::get('/setting/places/departments', 'PlacesController@departmentsTo')->name('places.departments');
  Route::post('/setting/places/departments/save', 'PlacesController@saveDepartments')->name('departments.save');
  Route::post('/setting/places/departments/update', 'PlacesController@updateDepartments')->name('departments.update');
  Route::post('/setting/places/departments/delete', 'PlacesController@deleteDepartments')->name('departments.delete');
  // Municipios
  Route::get('/setting/places/municipalities', 'PlacesController@municipalitiesTo')->name('places.municipalities');
  Route::post('/setting/places/municipalities/save', 'PlacesController@saveMunicipalities')->name('municipalities.save');
  Route::post('/setting/places/municipalities/update', 'PlacesController@updateMunicipalities')->name('municipalities.update');
  Route::post('/setting/places/municipalities/delete', 'PlacesController@deleteMunicipalities')->name('municipalities.delete');
  // Zonificacion
  Route::get('/setting/places/zoning', 'PlacesController@zoningTo')->name('places.zoning');
  Route::post('/setting/places/zoning/save', 'PlacesController@saveZonings')->name('zonings.save');
  Route::post('/setting/places/zoning/update', 'PlacesController@updateZonings')->name('zonings.update');
  Route::post('/setting/places/zoning/delete', 'PlacesController@deleteZonings')->name('zonings.delete');
  // Barrios
  Route::get('/setting/places/neighborhoods', 'PlacesController@neighborhoodsTo')->name('places.neighborhoods');
  Route::post('/setting/places/neighborhoods/save', 'PlacesController@saveNeighborhoods')->name('neighborhoods.save');
  Route::post('/setting/places/neighborhoods/update', 'PlacesController@updateNeighborhoods')->name('neighborhoods.update');
  Route::post('/setting/places/neighborhoods/delete', 'PlacesController@deleteNeighborhoods')->name('neighborhoods.delete');

  // CONFIGURACION >> SEGURIDAD SOCIAL

  // Entidades promotoras de salud
  Route::get('/setting/security/health', 'SecurityController@healthTo')->name('security.health');
  Route::post('/setting/security/health/save', 'SecurityController@saveHealths')->name('healths.save');
  Route::post('/setting/security/health/update', 'SecurityController@updateHealths')->name('healths.update');
  Route::post('/setting/security/health/delete', 'SecurityController@deleteHealths')->name('healths.delete');
  // Fondo de pensiones
  Route::get('/setting/security/pensions', 'SecurityController@pensionsTo')->name('security.pensions');
  Route::post('/setting/security/pensions/save', 'SecurityController@savePensions')->name('pensions.save');
  Route::post('/setting/security/pensions/update', 'SecurityController@updatePensions')->name('pensions.update');
  Route::post('/setting/security/pensions/delete', 'SecurityController@deletePensions')->name('pensions.delete');
  // Fondo de cesantias
  Route::get('/setting/security/layoffs', 'SecurityController@layoffsTo')->name('security.layoffs');
  Route::post('/setting/security/layoffs/save', 'SecurityController@saveLayoffs')->name('layoffs.save');
  Route::post('/setting/security/layoffs/update', 'SecurityController@updateLayoffs')->name('layoffs.update');
  Route::post('/setting/security/layoffs/delete', 'SecurityController@deleteLayoffs')->name('layoffs.delete');
  //Riesgos laborales
  Route::get('/setting/security/risks', 'SecurityController@risksTo')->name('security.risks');
  Route::post('/setting/security/risks/save', 'SecurityController@saveRisks')->name('risks.save');
  Route::post('/setting/security/risks/update', 'SecurityController@updateRisks')->name('risks.update');
  Route::post('/setting/security/risks/delete', 'SecurityController@deleteRisks')->name('risks.delete');
  // Caja de compensacion
  Route::get('/setting/security/compensations', 'SecurityController@compensationsTo')->name('security.compensations');
  Route::post('/setting/security/compensations/save', 'SecurityController@saveCompensations')->name('compensations.save');
  Route::post('/setting/security/compensations/update', 'SecurityController@updateCompensations')->name('compensations.update');
  Route::post('/setting/security/compensations/delete', 'SecurityController@deleteCompensations')->name('compensations.delete');

  // CONFIGURACION >> DOCUMENTOS

  // Identificacion personal
  Route::get('/setting/documents/personal', 'DocumentsController@personalTo')->name('documents.personal');
  Route::post('/setting/documents/personal/save', 'DocumentsController@savePersonals')->name('personals.save');
  Route::post('/setting/documents/personal/update', 'DocumentsController@updatePersonals')->name('personals.update');
  Route::post('/setting/documents/personal/delete', 'DocumentsController@deletePersonals')->name('personals.delete');
  // Licencias de conducción
  Route::get('/setting/documents/driving', 'DocumentsController@drivingTo')->name('documents.driving');
  Route::post('/setting/documents/driving/save', 'DocumentsController@saveDrivings')->name('driving.save');
  Route::post('/setting/documents/driving/update', 'DocumentsController@updateDrivings')->name('driving.update');
  Route::post('/setting/documents/driving/delete', 'DocumentsController@deleteDrivings')->name('driving.delete');
  // Cursos certificados
  Route::get('/setting/documents/courses', 'DocumentsController@coursesTo')->name('documents.courses');
  Route::post('/setting/documents/courses/save', 'DocumentsController@saveCourses')->name('course.save');
  Route::post('/setting/documents/courses/update', 'DocumentsController@updateCourses')->name('course.update');
  Route::post('/setting/documents/courses/delete', 'DocumentsController@deleteCourses')->name('course.delete');
  // Polizas y seguros
  Route::get('/setting/documents/insurances', 'DocumentsController@insurancesTo')->name('documents.insurances');
  Route::post('/setting/documents/insurances/save', 'DocumentsController@saveInsurances')->name('insurance.save');
  Route::post('/setting/documents/insurances/update', 'DocumentsController@updateInsurances')->name('insurance.update');
  Route::post('/setting/documents/insurances/delete', 'DocumentsController@deleteInsurances')->name('insurance.delete');
  // Legalizacion de vehículos
  Route::get('/setting/documents/legalization', 'DocumentsController@legalizationTo')->name('documents.legalization');
  Route::post('/setting/documents/legalization/save', 'DocumentsController@saveLegalizations')->name('legalization.save');
  Route::post('/setting/documents/legalization/update', 'DocumentsController@updateLegalizations')->name('legalization.update');
  Route::post('/setting/documents/legalization/delete', 'DocumentsController@deleteLegalizations')->name('legalization.delete');

  // CONFIGURACION >> TIPOS DE VEHICULOS

  // Motocicletas
  Route::get('/setting/vehicle/motorcycles', 'VehiclesController@motorcyclesTo')->name('vehicle.motorcycles');
  Route::post('/setting/vehicle/motorcycles/save', 'VehiclesController@saveMotorcycles')->name('motorcycles.save');
  Route::post('/setting/vehicle/motorcycles/update', 'VehiclesController@updateMotorcycles')->name('motorcycles.update');
  Route::post('/setting/vehicle/motorcycles/delete', 'VehiclesController@deleteMotorcycles')->name('motorcycles.delete');
  // Carga
  Route::get('/setting/vehicle/heavy', 'VehiclesController@heavyTo')->name('vehicle.heavy');
  Route::post('/setting/vehicle/heavy/save', 'VehiclesController@saveHeavys')->name('heavys.save');
  Route::post('/setting/vehicle/heavy/update', 'VehiclesController@updateHeavys')->name('heavys.update');
  Route::post('/setting/vehicle/heavy/delete', 'VehiclesController@deleteHeavys')->name('heavys.delete');
  // Especial
  Route::get('/setting/vehicle/especial', 'VehiclesController@especialTo')->name('vehicle.especial');
  Route::post('/setting/vehicle/especial/save', 'VehiclesController@saveEspecials')->name('especials.save');
  Route::post('/setting/vehicle/especial/update', 'VehiclesController@updateEspecials')->name('especials.update');
  Route::post('/setting/vehicle/especial/delete', 'VehiclesController@deleteEspecials')->name('especials.delete');

  // CONFIGURACION >> TIPOS DE PRODUCTOS

  // Mensajeria
  Route::get('/setting/products/messenger', 'ProductsController@messengerTo')->name('products.messenger');
  Route::post('/setting/products/messenger/save', 'ProductsController@saveMessengers')->name('products.messenger.save');
  Route::post('/setting/products/messenger/update', 'ProductsController@updateMessengers')->name('products.messenger.update');
  Route::post('/setting/products/messenger/delete', 'ProductsController@deleteMessengers')->name('products.messenger.delete');
  // Logistica
  Route::get('/setting/products/logistic', 'ProductsController@logisticTo')->name('products.logistic');
  Route::post('/setting/products/logistic/save', 'ProductsController@saveLogistics')->name('products.logistic.save');
  Route::post('/setting/products/logistic/update', 'ProductsController@updateLogistics')->name('products.logistic.update');
  Route::post('/setting/products/logistic/delete', 'ProductsController@deleteLogistics')->name('products.logistic.delete');
  //Carga express
  Route::get('/setting/products/express', 'ProductsController@expressTo')->name('products.express');
  Route::post('/setting/products/express/save', 'ProductsController@saveExpress')->name('products.express.save');
  Route::post('/setting/products/express/update', 'ProductsController@updateExpress')->name('products.express.update');
  Route::post('/setting/products/express/delete', 'ProductsController@deleteExpress')->name('products.express.delete');
  // Turismo
  Route::get('/setting/products/tourism', 'ProductsController@tourismTo')->name('products.tourism');
  Route::post('/setting/products/tourism/save', 'ProductsController@saveTourism')->name('products.tourism.save');
  Route::post('/setting/products/tourism/update', 'ProductsController@updateTourism')->name('products.tourism.update');
  Route::post('/setting/products/tourism/delete', 'ProductsController@deleteTourism')->name('products.tourism.delete');
  // Traslados urbanos
  Route::get('/setting/products/transfers', 'ProductsController@transfersTo')->name('products.transfers');
  Route::post('/setting/products/transfers/save', 'ProductsController@saveTransfers')->name('products.transfers.save');
  Route::post('/setting/products/transfers/update', 'ProductsController@updateTransfers')->name('products.transfers.update');
  Route::post('/setting/products/transfers/delete', 'ProductsController@deleteTransfers')->name('products.transfers.delete');
  // Traslados intermunicipales
  Route::get('/setting/products/transfersmunicipals', 'ProductsController@transfersmunicipalsTo')->name('products.transfersmunicipals');
  Route::post('/setting/products/transfersmunicipals/save', 'ProductsController@saveTransfersmunicipals')->name('products.transfersmunicipals.save');
  Route::post('/setting/products/transfersmunicipals/update', 'ProductsController@updateTransfersmunicipals')->name('products.transfersmunicipals.update');
  Route::post('/setting/products/transfersmunicipals/delete', 'ProductsController@deleteTransfersmunicipals')->name('products.transfersmunicipals.delete');

  // CONFIGURACION >> TIPOS DE SERVICIOS

  // Mensajeria
  Route::get('/setting/services/messenger', 'ServicesController@messengerTo')->name('services.messenger');
  Route::post('/setting/services/messenger/save', 'ServicesController@saveMessengers')->name('services.messenger.save');
  Route::post('/setting/services/messenger/update', 'ServicesController@updateMessengers')->name('services.messenger.update');
  Route::post('/setting/services/messenger/delete', 'ServicesController@deleteMessengers')->name('services.messenger.delete');
  // Logistica
  Route::get('/setting/services/logistic', 'ServicesController@logisticTo')->name('services.logistic');
  Route::post('/setting/services/logistic/save', 'ServicesController@saveLogistics')->name('services.logistic.save');
  Route::post('/setting/services/logistic/update', 'ServicesController@updateLogistics')->name('services.logistic.update');
  Route::post('/setting/services/logistic/delete', 'ServicesController@deleteLogistics')->name('services.logistic.delete');
  //Carga express
  Route::get('/setting/services/express', 'ServicesController@expressTo')->name('services.express');
  Route::post('/setting/services/express/save', 'ServicesController@saveExpress')->name('services.express.save');
  Route::post('/setting/services/express/update', 'ServicesController@updateExpress')->name('services.express.update');
  Route::post('/setting/services/express/delete', 'ServicesController@deleteExpress')->name('services.express.delete');
  // Turismo	
  Route::get('/setting/services/tourism', 'ServicesController@tourismTo')->name('services.tourism');
  Route::post('/setting/services/tourism/save', 'ServicesController@saveTourism')->name('services.tourism.save');
  Route::post('/setting/services/tourism/update', 'ServicesController@updateTourism')->name('services.tourism.update');
  Route::post('/setting/services/tourism/delete', 'ServicesController@deleteTourism')->name('services.tourism.delete');
  // Traslados urbanos
  Route::get('/setting/services/transfers', 'ServicesController@transfersTo')->name('services.transfers');
  Route::post('/setting/services/transfers/save', 'ServicesController@saveTransfers')->name('services.transfers.save');
  Route::post('/setting/services/transfers/update', 'ServicesController@updateTransfers')->name('services.transfers.update');
  Route::post('/setting/services/transfers/delete', 'ServicesController@deleteTransfers')->name('services.transfers.delete');
  // Traslados intermunicipales
  Route::get('/setting/services/transfersmunicipals', 'ServicesController@transfersmunicipalsTo')->name('services.transfersmunicipals');
  Route::post('/setting/services/transfersmunicipals/save', 'ServicesController@saveTransfersmunicipals')->name('services.transfersmunicipals.save');
  Route::post('/setting/services/transfersmunicipals/update', 'ServicesController@updateTransfersmunicipals')->name('services.transfersmunicipals.update');
  Route::post('/setting/services/transfersmunicipals/delete', 'ServicesController@deleteTransfersmunicipals')->name('services.transfersmunicipals.delete');
});

//RUTAS DEL MODULO ADMINISTRATIVO
Route::group(['middleware' => ['role:ADMINISTRADOR SISTEMA|ADMINISTRADOR']], function () {

  // ADMINISTRATIVA >> CONFIGURACION DE EMPRESA

  // Información Jurídica
  Route::get('/administrative/company/legal', 'CompanyController@legalTo')->name('company.legal');
  Route::post('/administrative/company/legal/save', 'CompanyController@saveLegals')->name('legal.save');
  Route::post('/administrative/company/legal/update', 'CompanyController@updateLegals')->name('legal.update');
  Route::post('/administrative/company/legal/delete', 'CompanyController@deleteLegals')->name('legal.delete');
  // Información Financiera
  Route::get('/administrative/company/financial', 'CompanyController@financialTo')->name('company.financial');
  Route::post('/administrative/company/financial/save', 'CompanyController@saveFinancials')->name('financial.save');
  Route::post('/administrative/company/financial/update', 'CompanyController@updateFinancials')->name('financial.update');
  Route::post('/administrative/company/financial/delete', 'CompanyController@deleteFinancials')->name('financial.delete');
  // Información técnica
  Route::get('/administrative/company/technical', 'CompanyController@technicalTo')->name('company.technical');
  Route::post('/administrative/company/technical/save', 'CompanyController@saveTechnical')->name('technical.save');
  Route::post('/administrative/company/technical/update', 'CompanyController@updateTechnical')->name('technical.update');
  Route::post('/administrative/company/technical/delete', 'CompanyController@deleteTechnical')->name('technical.delete');

  // ADMINISTRATIVA >> CONFIGURACION RECURSOS HUMANOS

  // Colaboradores
  Route::get('/administrative/humans/collaborators', 'HumansController@collaboratorsTo')->name('humans.collaborators');
  Route::post('/administrative/humans/collaborators/save', 'HumansController@saveCollaborator')->name('collaborator.save');
  Route::post('/administrative/humans/collaborators/update', 'HumansController@updateCollaborator')->name('collaborator.update');
  Route::post('/administrative/humans/collaborators/delete', 'HumansController@deleteCollaborator')->name('collaborator.delete');
  // Contratistas Mensajeria
  Route::get('/administrative/humans/contractorsMessenger', 'HumansController@contractorsMessengerTo')->name('humans.contractorsMessenger');
  Route::post('/administrative/humans/contractorsMessenger/save', 'HumansController@saveContractorsmessenger')->name('contractorsMessenger.save');
  Route::post('/administrative/humans/contractorsMessenger/update', 'HumansController@updateContractorsmessenger')->name('contractorsMessenger.update');
  Route::post('/administrative/humans/contractorsMessenger/delete', 'HumansController@deleteContractorsmessenger')->name('contractorsMessenger.delete');
  // Contratistas Carga Express
  Route::get('/administrative/humans/contractorsExpress', 'HumansController@contractorsExpressTo')->name('humans.contractorsExpress');
  Route::post('/administrative/humans/contractorsExpress/save', 'HumansController@saveContractorscharge')->name('contractorsExpress.save');
  Route::post('/administrative/humans/contractorsExpress/update', 'HumansController@updateContractorscharge')->name('contractorsExpress.update');
  Route::post('/administrative/humans/contractorsExpress/delete', 'HumansController@deleteContractorscharge')->name('contractorsExpress.delete');
  // Contratistas Servicios especiales
  Route::get('/administrative/humans/contractorsEspecial', 'HumansController@contractorsEspecialTo')->name('humans.contractorsEspecial');
  Route::post('/administrative/humans/contractorsEspecial/save', 'HumansController@saveContractorsespecial')->name('contractorsEspecial.save');
  Route::post('/administrative/humans/contractorsEspecial/update', 'HumansController@updateContractorsespecial')->name('contractorsEspecial.update');
  Route::post('/administrative/humans/contractorsEspecial/delete', 'HumansController@deleteContractorsespecial')->name('contractorsEspecial.delete');

  // ADMINISTRATIVA >> CONFIGURACION PROVEEDORES

  // Productos
  Route::get('/administrative/providers/products', 'ProvidersController@productsTo')->name('providers.products');
  Route::post('/administrative/providers/products/save', 'ProvidersController@saveProduct')->name('providers.products.save');
  Route::post('/administrative/providers/products/update', 'ProvidersController@updateProduct')->name('providers.products.update');
  Route::post('/administrative/providers/products/delete', 'ProvidersController@deleteProduct')->name('providers.products.delete');
  // Servicios
  Route::get('/administrative/providers/services', 'ProvidersController@servicesTo')->name('providers.services');
  Route::post('/administrative/providers/services/save', 'ProvidersController@saveService')->name('providers.services.save');
  Route::post('/administrative/providers/services/update', 'ProvidersController@updateService')->name('providers.services.update');
  Route::post('/administrative/providers/services/delete', 'ProvidersController@deleteService')->name('providers.services.delete');
  // Proveedores
  Route::get('/administrative/providers/providers', 'ProvidersController@providersTo')->name('providers.providers');
  Route::post('/administrative/providers/providers/save', 'ProvidersController@saveProvider')->name('providers.providers.save');
  Route::post('/administrative/providers/providers/update', 'ProvidersController@updateProvider')->name('providers.providers.update');
  Route::post('/administrative/providers/providers/delete', 'ProvidersController@deleteProvider')->name('providers.providers.delete');

  // ADMINISTRATIVA >> CONFIGURACION EMPRESAS ALIADAS

  // Mensajeria
  Route::get('/administrative/allies/messengers', 'AlliesController@messengersTo')->name('allies.messengers');
  Route::post('/administrative/allies/messengers/save', 'AlliesController@saveMessenger')->name('allies.messengers.save');
  Route::post('/administrative/allies/messengers/update', 'AlliesController@updateMessenger')->name('allies.messengers.update');
  Route::post('/administrative/allies/messengers/delete', 'AlliesController@deleteMessenger')->name('allies.messengers.delete');
  // Carga Express
  Route::get('/administrative/allies/express', 'AlliesController@expressTo')->name('allies.express');
  Route::post('/administrative/allies/express/save', 'AlliesController@saveExpress')->name('allies.express.save');
  Route::post('/administrative/allies/express/update', 'AlliesController@updateExpress')->name('allies.express.update');
  Route::post('/administrative/allies/express/delete', 'AlliesController@deleteExpress')->name('allies.express.delete');
  // Servicios especiales
  Route::get('/administrative/allies/services', 'AlliesController@servicesTo')->name('allies.services');
  Route::post('/administrative/allies/services/save', 'AlliesController@saveService')->name('allies.services.save');
  Route::post('/administrative/allies/services/update', 'AlliesController@updateService')->name('allies.services.update');
  Route::post('/administrative/allies/services/delete', 'AlliesController@deleteService')->name('allies.services.delete');

  // ADMINISTRATIVA >> CONFIGURACION PARQUE AUTOMOTOR

  // Mensajeria
  Route::get('/administrative/automotors/messengers', 'AutomotorsController@messengersTo')->name('automotors.messengers');
  Route::post('/administrative/automotors/messengers/save', 'AutomotorsController@saveMessenger')->name('automotors.messengers.save');
  Route::post('/administrative/automotors/messengers/update', 'AutomotorsController@updateMessenger')->name('automotors.messengers.update');
  Route::post('/administrative/automotors/messengers/delete', 'AutomotorsController@deleteMessenger')->name('automotors.messengers.delete');
  // Carga Express
  Route::get('/administrative/automotors/express', 'AutomotorsController@expressTo')->name('automotors.express');
  Route::post('/administrative/automotors/express/save', 'AutomotorsController@saveExpress')->name('automotors.express.save');
  Route::post('/administrative/automotors/express/update', 'AutomotorsController@updateExpress')->name('automotors.express.update');
  Route::post('/administrative/automotors/express/delete', 'AutomotorsController@deleteExpress')->name('automotors.express.delete');
  // Servicios especiales
  Route::get('/administrative/automotors/services', 'AutomotorsController@servicesTo')->name('automotors.services');
  Route::post('/administrative/automotors/services/save', 'AutomotorsController@saveService')->name('automotors.services.save');
  Route::post('/administrative/automotors/services/update', 'AutomotorsController@updateService')->name('automotors.services.update');
  Route::post('/administrative/automotors/services/delete', 'AutomotorsController@deleteService')->name('automotors.services.delete');
});

// RUTAS DEL MODULO GERENCIAL
Route::group(['middleware' => ['role:ADMINISTRADOR SISTEMA|ADMINISTRADOR']], function () {

  // GERENCIAL >> COMITES
  Route::get('/managerial/commitee/minutes-commitee', 'CommiteeController@commiteeindex')->name('commitee.index');
  Route::post('/managerial/commitee/new-minutes', 'CommiteeController@commiteesave')->name('commitee.save');
  Route::patch('/managerial/commitee/update-minutes', 'CommiteeController@commiteeupdate')->name('commitee.update');
  Route::delete('/managerial/commitee/destroy-minutes', 'CommiteeController@commiteedestroy')->name('commitee.destroy');
  Route::put('/managerial/commitee/approved', 'CommiteeController@approvedminutes')->name('commitee.approved');
  Route::post('managerial/commitee/pdf-minutes', 'CommiteeController@pdfminutes')->name('commitee.pdf');
  Route::get('/managerial/commitee/minutes-in-process', 'CommiteeController@processindex')->name('process.commitee');
  Route::get('/managerial/commitee/minutes-file', 'CommiteeController@fileindex')->name('file.commitee');
  // GERENCIAL >> PROCEDIMIENTOS
  Route::get('/managerial/procedure/implementation-procedures', 'ProcedureController@implementationindex')->name('implementation.index');
  Route::post('/managerial/procedure/new-procedures', 'ProcedureController@implementationsave')->name('implementation.save');
  Route::patch('/managerial/procedure/update-procedures', 'ProcedureController@implementationupdate')->name('implementation.update');
  Route::delete('/managerial/procedure/destroy-procedures', 'ProcedureController@implementationdestroy')->name('implementation.destroy');
  Route::put('/managerial/procedure/approved', 'ProcedureController@approvedimplementation')->name('implementation.approved');
  Route::post('/managerial/procedure/pdf-implementation', 'ProcedureController@pdfimplementation')->name('implementation.pdf');
  Route::get('managerial/procedure/procedures-in-process', 'ProcedureController@processindex')->name('process.procedures');
  Route::get('managerial/procedure/procedures-file', 'ProcedureController@fileindex')->name('file.procedures');
  // GERENCIAL >> DOCUMENTOS
  Route::get('/managerial/document/legal-parent', 'DocumentsManagementController@legalindex')->name('legal.index');
  Route::post('/managerial/document/legal-parent/save', 'DocumentsManagementController@legalsave')->name('legal.save');
  Route::patch('/managerial/document/legal-parent/update', 'DocumentsManagementController@legalupdate')->name('legal.update');
  Route::delete('/managerial/document/legal-parent/destroy', 'DocumentsManagementController@legaldestroy')->name('legal.destroy');
  Route::post('/managerial/document/legal-parent/PDF', 'DocumentsManagementController@legalpdf')->name('PDFMatriz');
  Route::get('/managerial/document/analysis-matrix', 'DocumentsManagementController@analysisindex')->name('analysis.index');
  Route::post('/managerial/document/analysis-matrix/save', 'DocumentsManagementController@analysissave')->name('analysis.save');
  Route::patch('/managerial/document/analysis-matrix/update', 'DocumentsManagementController@analysisupdate')->name('analysis.update');
  Route::delete('/managerial/document/analysis-matrix/destroy', 'DocumentsManagementController@analysisdestroy')->name('analysis.destroy');
  Route::get('/managerial/document/matrix-epp', 'DocumentsManagementController@matrixindex')->name('matriz.index');
  Route::get('/managerial/document/accountability', 'DocumentsManagementController@accountabilityindex')->name('accountability.index');
  Route::get('/managerial/document/programs', 'DocumentsManagementController@programsindex')->name('program.index');
});

//RUTAS DEL MODULO COMERCIAL
Route::group(['middleware' => ['role:ADMINISTRADOR SISTEMA|ADMINISTRADOR']], function () {

  // COMERCIAL >> TABLA DE TARIFAS

  // Mensajeria express
  Route::get('/comercial/tariffs/messenger', 'TariffsController@messengersExpressTo')->name('tariffs.messenger');
  Route::post('/comercial/tariffs/messenger/save', 'TariffsController@saveMessengersexpress')->name('tariffs.messenger.save');
  Route::post('/comercial/tariffs/messenger/update', 'TariffsController@updateMessengersexpress')->name('tariffs.messenger.update');
  Route::post('/comercial/tariffs/messenger/delete', 'TariffsController@deleteMessengersexpress')->name('tariffs.messenger.delete');
  // Logistica express
  Route::get('/comercial/tariffs/logistic', 'TariffsController@logisticExpressTo')->name('tariffs.logistic');
  Route::post('/comercial/tariffs/logistic/save', 'TariffsController@saveLogisticsexpress')->name('tariffs.logistic.save');
  Route::post('/comercial/tariffs/logistic/update', 'TariffsController@updateLogisticsexpress')->name('tariffs.logistic.update');
  Route::post('/comercial/tariffs/logistic/delete', 'TariffsController@deleteLogisticsexpress')->name('tariffs.logistic.delete');
  // Carga express
  Route::get('/comercial/tariffs/charge', 'TariffsController@chargeExpressTo')->name('tariffs.charge');
  Route::post('/comercial/tariffs/charge/save', 'TariffsController@saveChargeexpress')->name('tariffs.charge.save');
  Route::post('/comercial/tariffs/charge/update', 'TariffsController@updateChargeexpress')->name('tariffs.charge.update');
  Route::post('/comercial/tariffs/charge/delete', 'TariffsController@deleteChargeexpress')->name('tariffs.charge.delete');
  // Turismo express
  Route::get('/comercial/tariffs/turism', 'TariffsController@turismExpressTo')->name('tariffs.turism');
  Route::post('/comercial/tariffs/turism/save', 'TariffsController@saveTurismexpress')->name('tariffs.turism.save');
  Route::post('/comercial/tariffs/turism/update', 'TariffsController@updateTurismexpress')->name('tariffs.turism.update');
  Route::post('/comercial/tariffs/turism/delete', 'TariffsController@deleteTurismexpress')->name('tariffs.turism.delete');
  // Traslado urbano
  Route::get('/comercial/tariffs/transfer', 'TariffsController@transferExpressTo')->name('tariffs.transfer');
  Route::post('/comercial/tariffs/transfer/save', 'TariffsController@saveTransferexpress')->name('tariffs.transfer.save');
  Route::post('/comercial/tariffs/transfer/update', 'TariffsController@updateTransferexpress')->name('tariffs.transfer.update');
  Route::post('/comercial/tariffs/transfer/delete', 'TariffsController@deleteTransferexpress')->name('tariffs.transfer.delete');
  // Traslado intermunicipal
  Route::get('/comercial/tariffs/transferintermunipality', 'TariffsController@transferintermunipalityTo')->name('tariffs.transferintermunipality');
  Route::post('/comercial/tariffs/transferintermunipality/save', 'TariffsController@saveTransferintermunipality')->name('tariffs.transferintermunipality.save');
  Route::post('/comercial/tariffs/transferintermunipality/update', 'TariffsController@updateTransferintermunipality')->name('tariffs.transferintermunipality.update');
  Route::post('/comercial/tariffs/transferintermunipality/delete', 'TariffsController@deleteTransferintermunipality')->name('tariffs.transferintermunipality.delete');


  // COMERCIAL >> PLAN DE MERCADEO

  // Oportunidad de negocios
  Route::get('/comercial/marketing/opportunity', 'MarketingController@opportunityTo')->name('marketing.opportunity');
  Route::post('/comercial/marketing/opportunity/save', 'MarketingController@saveOpportunity')->name('marketing.opportunity.save');
  Route::post('/comercial/marketing/opportunity/yes', 'MarketingController@yesOpportunity')->name('marketing.opportunity.yes');
  Route::post('/comercial/marketing/opportunity/no', 'MarketingController@noOpportunity')->name('marketing.opportunity.no');
  // Seguimiento de negocios
  Route::get('/comercial/marketing/tracking', 'MarketingController@trackingTo')->name('marketing.tracking');
  Route::post('/comercial/marketing/tracking/save', 'MarketingController@saveTracking')->name('marketing.tracking.save');
  // Archivo de negocios
  Route::get('/comercial/marketing/records', 'MarketingController@recordsTo')->name('marketing.records');
  // Estadistica
  Route::get('/comercial/marketing/statistic', 'MarketingController@statisticTo')->name('marketing.statistic');
  Route::get('/comercial/marketing/statistic/aproved', 'MarketingController@getMarketingAproved')->name('marketing.statistic.aproved');
  Route::get('/comercial/marketing/statistic/notaproved', 'MarketingController@getMarketingNotAproved')->name('marketing.statistic.notaproved');
  Route::get('/comercial/marketing/statistic/pending', 'MarketingController@getMarketingPending')->name('marketing.statistic.pending');

  // COMERCIAL >> CLIENTE POTENCIAL

  // Licitaciones públicas
  Route::get('/comercial/clients/bidding', 'ClientsController@biddingTo')->name('clients.bidding');
  Route::post('/comercial/clients/bidding/save', 'ClientsController@saveBidding')->name('clients.bidding.save');
  Route::post('/comercial/clients/bidding/yes', 'ClientsController@yesBidding')->name('clients.bidding.yes');
  Route::post('/comercial/clients/bidding/no', 'ClientsController@noBidding')->name('clients.bidding.no');
  // Propuesta comercial
  Route::get('/comercial/clients/proposal', 'ClientsController@proposalTo')->name('clients.proposal');
  Route::post('/comercial/clients/proposal/save', 'ClientsController@saveProposal')->name('clients.proposal.save');
  Route::post('/comercial/clients/proposal/yes', 'ClientsController@yesProposal')->name('clients.proposal.yes');
  Route::post('/comercial/clients/proposal/no', 'ClientsController@noProposal')->name('clients.proposal.no');
  // Seguimiento comercial
  Route::get('/comercial/clients/tracking', 'ClientsController@trackingTo')->name('clients.tracking');
  Route::post('/comercial/clients/tracking/save', 'ClientsController@saveTracking')->name('clients.tracking.save');
  Route::post('/comercial/clients/tracking/proposal/save', 'ClientsController@saveTrackingproposal')->name('clients.tracking.proposal.save');
  // Archivo comercial
  Route::get('/comercial/clients/records', 'ClientsController@recordsTo')->name('clients.records');
  // Estadistica
  Route::get('/comercial/clients/statistic', 'ClientsController@statisticTo')->name('clients.statistic');
  Route::get('/comercial/clients/statistic/aproved', 'ClientsController@getClientAproved')->name('clients.statistic.aproved');
  Route::get('/comercial/clients/statistic/notaproved', 'ClientsController@getClientsNotAproved')->name('clients.statistic.notaproved');
  Route::get('/comercial/clients/statistic/pending', 'ClientsController@getClientsPending')->name('clients.statistic.pending');

  // COMERCIAL >> CONTRATOS PERMANENTES

  // Clientes
  Route::get('/comercial/permanent/clients', 'PermanentcontractsController@clientsTo')->name('permanent.clients');
  Route::post('/comercial/permanent/clients/save', 'PermanentcontractsController@saveClient')->name('permanent.clients.save');
  Route::post('/comercial/permanent/clients/natural/update', 'PermanentcontractsController@updateClientnatural')->name('permanent.clients.natural.update');
  Route::post('/comercial/permanent/clients/juridica/update', 'PermanentcontractsController@updateClientjuridica')->name('permanent.clients.juridica.update');
  Route::post('/comercial/permanent/clients/natural/delete', 'PermanentcontractsController@deleteClientnatural')->name('permanent.clients.natural.delete');
  Route::post('/comercial/permanent/clients/juridica/delete', 'PermanentcontractsController@deleteClientjuridica')->name('permanent.clients.juridica.delete');
  // Legalización contractual
  Route::get('/comercial/permanent/legalizations', 'PermanentcontractsController@legalizationsTo')->name('permanent.legalizations');
  Route::post('/comercial/permanent/legalizations/save', 'PermanentcontractsController@saveLegalizations')->name('permanent.legalizations.save');
  Route::post('/comercial/permanent/legalizations/update', 'PermanentcontractsController@updateLegalizations')->name('permanent.legalizations.update');
  Route::post('/comercial/permanent/legalizations/delete', 'PermanentcontractsController@deleteLegalizations')->name('permanent.legalizations.delete');
  Route::get('/comercial/permanent/legalizations/pdf', 'PermanentcontractsController@pdfLegalizations')->name('permanent.legalizations.pdf');
  // Condiciones económicas
  Route::get('/comercial/permanent/conditions', 'PermanentcontractsController@conditionsTo')->name('permanent.conditions');
  Route::post('/comercial/permanent/conditions/save', 'PermanentcontractsController@saveConditions')->name('permanent.conditions.save');
  Route::post('/comercial/permanent/conditions/update', 'PermanentcontractsController@updateConditions')->name('permanent.conditions.update');
  Route::post('/comercial/permanent/conditions/delete', 'PermanentcontractsController@deleteConditions')->name('permanent.conditions.delete');
  Route::get('/comercial/permanent/conditions/pdf', 'PermanentcontractsController@pdfConditions')->name('permanent.conditions.pdf');
  // Archivo de contratos
  Route::get('/comercial/permanent/records', 'PermanentcontractsController@recordsTo')->name('permanent.records');
  // Estadistica
  Route::get('/comercial/permanent/statistic', 'PermanentcontractsController@statisticTo')->name('permanent.statistic');
  Route::get('/comercial/permanent/statistic/now', 'PermanentcontractsController@getLegalizationsnow')->name('permanent.statistic.now');
  Route::get('/comercial/permanent/statistic/not', 'PermanentcontractsController@getLegalizationsnot')->name('permanent.statistic.not');

  // COMERCIAL >> CONTRATOS OCASIONALES

  // Orden de servicio
  Route::get('/comercial/occasional/orders', 'OccasionalcontractsController@ordersTo')->name('occasional.orders');
  Route::post('/comercial/occasional/orders/save', 'OccasionalcontractsController@saveOrder')->name('occasional.order.save');
  Route::post('/comercial/occasional/orders/update', 'OccasionalcontractsController@updateOrder')->name('occasional.order.update');
  Route::post('/comercial/occasional/orders/cancel', 'OccasionalcontractsController@cancelOrder')->name('occasional.order.cancel');
  Route::post('/comercial/occasional/orders/aproved', 'OccasionalcontractsController@aprovedOrder')->name('occasional.order.aproved');
  Route::get('/comercial/occasional/orders/pdf', 'OccasionalcontractsController@pdfOrder')->name('occasional.order.pdf');
  // Seguimiento de servicio Carga Express
  Route::get('/comercial/occasional/trackings', 'OccasionalcontractsController@trackingsTo')->name('occasional.trackings');
  // Servicio Especial
  Route::get('/comercial/occasional/statistic', 'OccasionalcontractsController@statisticTo')->name('occasional.statistic');
  Route::get('/comercial/occasional/statistic/vigente', 'OccasionalcontractsController@getVigente')->name('occasional.statistic.vigente');
  Route::get('/comercial/occasional/statistic/terminado', 'OccasionalcontractsController@getTerminado')->name('occasional.statistic.terminado');
});

//RUTAS DEL MODULO OPERATIVO
Route::group(['middleware' => ['role:ADMINISTRADOR SISTEMA|ADMINISTRADOR']], function () {

  // OPERATIVA >> SOLICITUD DE SERVICIOS

  // Mensajeria express
  Route::get('/operative/request/messenger', 'RequestController@messengersExpressTo')->name('request.messenger');
  Route::post('/operative/request/messenger/save', 'RequestController@messengersSave')->name('request.messenger.save');
  // Logistica express
  Route::get('/operative/request/logistic', 'RequestController@logisticExpressTo')->name('request.logistic');
  Route::post('/operative/request/logistic/save', 'RequestController@logisticSave')->name('request.logistic.save');
  // Carga express
  Route::get('/operative/request/charge', 'RequestController@chargeExpressTo')->name('request.charge');
  Route::post('/operative/request/charge/save', 'RequestController@chargeSave')->name('request.charge.save');
  // Servicio especial
  Route::get('/operative/request/turism', 'RequestController@turismTo')->name('request.turism');
  Route::post('/operative/request/turism/save', 'RequestController@turismSave')->name('request.turism.save');
  // Traslado
  Route::get('/operative/request/transfer', 'RequestController@transferTo')->name('request.transfer');
  Route::post('/operative/request/transfer/save', 'RequestController@transferSave')->name('request.transfer.save');
  // Traslado intermunicipal
  Route::get('/operative/request/transferintermunicipal', 'RequestController@transferintermunicipalTo')->name('request.transferintermunipal');

  // OPERATIVA >> PROGRAMACION DE SERVICIOS

  // Asignación operador
  Route::get('/operative/programming/assignment', 'ProgrammingController@assignmentsTo')->name('programming.assignment');
  // Aceptación operador
  Route::get('/operative/programming/acceptance', 'ProgrammingController@acceptancesTo')->name('programming.acceptance');
  // Informe de servicio
  Route::get('/operative/programming/report', 'ProgrammingController@reportsTo')->name('programming.report');

  // OPERATIVA >> SEGUIMIENTO DE SERVICIOS

  // Confirmación operador
  Route::get('/operative/tracking/confirmation', 'TrackingController@confirmationsTo')->name('tracking.confirmation');
  // Inicio del servicio
  Route::get('/operative/tracking/start', 'TrackingController@startsTo')->name('tracking.start');
  // Servicio en ejecución
  Route::get('/operative/tracking/running', 'TrackingController@runningsTo')->name('tracking.running');
  // Servicios finalizados
  Route::get('/operative/tracking/finalized', 'TrackingController@finalizedsTo')->name('tracking.finalized');

  // OPERATIVA >> LIQUIDACION DE SERVICIOS

  // Liquidación para clientes
  Route::get('/operative/settlement/clients', 'SettlementController@clientsTo')->name('settlement.clients');
  // Liquidación para operadores
  Route::get('/operative/settlement/operators', 'SettlementController@operatorsTo')->name('settlement.operators');

  // OPERATIVA >> CALIFICACION DE SERVICIOS

  // Calificación del usuario
  Route::get('/operative/qualification/users', 'QualificationController@usersTo')->name('qualification.users');
  // Calificación del operador
  Route::get('/operative/qualification/operators', 'QualificationController@operatorsTo')->name('qualification.operators');
  // Estadisticas
  Route::get('/operative/qualification/statistic', 'QualificationController@statisticsTo')->name('qualification.statistic');
});

//RUTAS DEL MODULO FINANCIERO
Route::group(['middleware' => ['role:ADMINISTRADOR SISTEMA|ADMINISTRADOR']], function () {

  // FINANCIERO >> CUENTAS POR COBRAR

  // Cuentas por cobrar
  Route::get('/financial/account/receivable', 'AccountsController@accountreceivableTo')->name('account.receivable');

  // FINANCIERO >> CUENTAS POR PAGAR

  // Cuentas por pagar
  Route::get('/financial/account/pay', 'AccountsController@accountpayTo')->name('account.pay');

  // FINANCIERO >> MOVIMIENTO DE INGRESOS

  // Facturación de venta
  Route::get('/financial/entrys/facturation', 'MovemententrysController@facturationsTo')->name('entrys.facturation');
  // Cartera vencida
  Route::get('/financial/entrys/wallet', 'MovemententrysController@walletsTo')->name('entrys.wallet');
  // Comprobantes de ingreso
  Route::get('/financial/entrys/voucher', 'MovemententrysController@vouchersTo')->name('entrys.voucher');
  // Estadísticas de venta
  Route::get('/financial/entrys/statistic', 'MovemententrysController@statisticTo')->name('entrys.statistic');

  // FINANCIERO >> MOVIMIENTO DE EGRESOS

  // Cuentas por pagar
  Route::get('/financial/egress/accounts', 'MovementegressController@accountsTo')->name('egress.accounts');
  // Obligaciones vencidas
  Route::get('/financial/egress/obligations', 'MovementegressController@obligationsTo')->name('egress.obligations');
  // Comprobantes de egreso
  Route::get('/financial/egress/vouchers', 'MovementegressController@vouchersTo')->name('egress.vouchers');
  // Estadísticas de gastos
  Route::get('/financial/egress/statistic', 'MovementegressController@statisticTo')->name('egress.statistic');

  // FINANCIERO >> ANALISIS DE PRESUPUESTO

  // Conciliación de saldos
  Route::get('/financial/analysis/conciliation', 'AnalysisbudgetController@conciliationTo')->name('analysis.conciliation');
  // Estructura de costos
  Route::get('/financial/analysis/structure', 'AnalysisbudgetController@structureTo')->name('analysis.structure');
  // Descripción de costos
  Route::get('/financial/analysis/description', 'AnalysisbudgetController@descriptionTo')->name('analysis.description');
  // Presupuesto anual
  Route::get('/financial/analysis/budget', 'AnalysisbudgetController@budgetTo')->name('analysis.budget');
  // Seguimiento mensual
  Route::get('/financial/analysis/tracking', 'AnalysisbudgetController@trackingTo')->name('analysis.tracking');
  // Informe de cierre
  Route::get('/financial/analysis/report', 'AnalysisbudgetController@reportTo')->name('analysis.report');
});

// RUTAS DEL MODULO INTEGRAL
Route::group(['middleware' => ['role:ADMINISTRADOR SISTEMA|ADMINISTRADOR']], function () {

  // INTEGRAL >> SG-GERENCIAL

  // Manual de funciones
  Route::get('/integral/managerial/hankbook', 'SGManagerialController@hankbookTo')->name('managerial.hankbook');
  Route::post('/integral/managerial/document/save', 'SGManagerialController@saveDocumentmanagerial')->name('managerial.document.save');
  Route::post('/integral/managerial/document/update', 'SGManagerialController@updateDocumentmanagerial')->name('managerial.document.update');
  Route::post('/integral/managerial/document/delete', 'SGManagerialController@deleteDocumentmanagerial')->name('managerial.document.delete');
  // Procedimientos
  Route::get('/integral/managerial/procedures', 'SGManagerialController@proceduresTo')->name('managerial.procedures');
  Route::post('/integral/managerial/procedures/save', 'SGManagerialController@saveVariableMNG')->name('managerial.variable.save');
  Route::post('/integral/managerial/procedures/update', 'SGManagerialController@updateVariableMNG')->name('managerial.variable.update');
  Route::post('/integral/managerial/procedures/delete', 'SGManagerialController@deleteVariableMNG')->name('managerial.variable.delete');
  // Planeación
  Route::get('/integral/managerial/planning', 'SGManagerialController@planingTo')->name('managerial.planing');
  Route::post('/integral/managerial/planing/save', 'SGManagerialController@saveConfigMNG')->name('managerial.configuration.save');
  Route::post('/integral/managerial/planing/update', 'SGManagerialController@updateConfigMNG')->name('managerial.configuration.update');
  Route::post('/integral/managerial/planing/delete', 'SGManagerialController@deleteConfigMNG')->name('managerial.configuration.delete');
  // Programas
  Route::get('/integral/managerial/programs', 'SGManagerialController@programsTo')->name('managerial.programs');
  // Documentos
  Route::get('/integral/managerial/documents', 'SGManagerialController@documentsTo')->name('managerial.documents');
  // Formatos
  Route::get('/integral/managerial/formats', 'SGManagerialController@formatsTo')->name('managerial.formats');

  // INTEGRAL >> SG-LOGISTICA

  // Manual de funciones
  Route::get('/integral/logistic/hankbook', 'SGLogisticController@hankbookTo')->name('logistic.hankbook');
  Route::post('/integral/logistic/document/save', 'SGLogisticController@saveDocumentlogistic')->name('logistic.document.save');
  Route::post('/integral/logistic/document/update', 'SGLogisticController@updateDocumentlogistic')->name('logistic.document.update');
  Route::post('/integral/logistic/document/delete', 'SGLogisticController@deleteDocumentlogistic')->name('logistic.document.delete');
  // Procedimientos
  Route::get('/integral/logistic/procedures', 'SGLogisticController@proceduresTo')->name('logistic.procedures');
  Route::post('/integral/logistic/procedures/save', 'SGLogisticController@saveVariable')->name('logistic.variable.save');
  Route::post('/integral/logistic/procedures/update', 'SGLogisticController@updateVariable')->name('logistic.variable.update');
  Route::post('/integral/logistic/procedures/delete', 'SGLogisticController@deleteVariable')->name('logistic.variable.delete');
  // Planeación
  Route::get('/integral/logistic/planning', 'SGLogisticController@planingTo')->name('logistic.planing');
  Route::post('/integral/logistic/configuration/save', 'SGLogisticController@saveConfiguration')->name('logistic.configuration.save');
  Route::post('/integral/logistic/configuration/update', 'SGLogisticController@updateConfiguration')->name('logistic.configuration.update');
  Route::post('/integral/logistic/configuration/delete', 'SGLogisticController@deleteConfiguration')->name('logistic.configuration.delete');
  // Programas
  Route::get('/integral/logistic/programs', 'SGLogisticController@programsTo')->name('logistic.programs');
  // Documentos
  Route::get('/integral/logistic/documents', 'SGLogisticController@documentsTo')->name('logistic.documents');
  // Formatos
  Route::get('/integral/logistic/formats', 'SGLogisticController@formatsTo')->name('logistic.formats');

  // INTEGRAL >> SG-COMERCIAL

  // Manual de funciones
  Route::get('/integral/commercial/hankbook', 'SGCommercialController@hankbookTo')->name('commercial.hankbook');
  Route::post('/integral/commercial/document/save', 'SGCommercialController@saveDocument')->name('commercial.document.save');
  Route::post('/integral/commercial/document/update', 'SGCommercialController@updateDocument')->name('commercial.document.update');
  Route::post('/integral/commercial/document/delete', 'SGCommercialController@deleteDocument')->name('commercial.document.delete');
  // Procedimientos
  Route::get('/integral/commercial/procedures', 'SGCommercialController@proceduresTo')->name('commercial.procedures');
  Route::post('/integral/commercial/variable/save', 'SGCommercialController@saveVariable')->name('commercial.variable.save');
  Route::post('/integral/commercial/variable/update', 'SGCommercialController@updateVariable')->name('commercial.variable.update');
  Route::post('/integral/commercial/variable/delete', 'SGCommercialController@deleteVariable')->name('commercial.variable.delete');
  // Planeación
  Route::get('/integral/commercial/planning', 'SGCommercialController@planingTo')->name('commercial.planing');
  Route::post('/integral/commercial/configuration/save', 'SGCommercialController@saveConfiguration')->name('commercial.configuration.save');
  Route::post('/integral/commercial/configuration/update', 'SGCommercialController@updateConfiguration')->name('commercial.configuration.update');
  Route::post('/integral/commercial/configuration/delete', 'SGCommercialController@deleteConfiguration')->name('commercial.configuration.delete');
  // Programas
  Route::get('/integral/commercial/programs', 'SGCommercialController@programsTo')->name('commercial.programs');
  // Documentos
  Route::get('/integral/commercial/documents', 'SGCommercialController@documentsTo')->name('commercial.documents');
  // Formatos
  Route::get('/integral/commercial/formats', 'SGCommercialController@formatsTo')->name('commercial.formats');

  // INTEGRAL >> SG-OPERATIVA

  // Manual de funciones
  Route::get('/integral/operative/hankbook', 'SGOperativeController@hankbookTo')->name('operative.hankbook');
  Route::post('/integral/operative/hankbook/save', 'SGOperativeController@saveDocumentOperative')->name('operative.document.save');
  Route::post('/integral/operative/hankbook/update', 'SGOperativeController@updateDocumentOperative')->name('operative.document.update');
  Route::post('/integral/operative/hankbook/delete', 'SGOperativeController@deleteDocumentOperative')->name('operative.document.delete');
  // Procedimientos
  Route::get('/integral/operative/procedures', 'SGOperativeController@proceduresTo')->name('operative.procedures');
  Route::post('/integral/operative/procedures/save', 'SGOperativeController@saveVariableOperative')->name('operative.variable.save');
  Route::post('/integral/operative/procedures/update', 'SGOperativeController@updateVariableOperative')->name('operative.variable.update');
  Route::post('/integral/operative/procedures/delete', 'SGOperativeController@deleteVariableOperative')->name('operative.variable.delete');
  // Planeación
  Route::get('/integral/operative/planning', 'SGOperativeController@planingTo')->name('operative.planing');
  Route::post('/integral/operative/planing/save', 'SGOperativeController@saveConfiguration')->name('operative.configuration.save');
  Route::post('/integral/operative/planing/update', 'SGOperativeController@updateConfiguration')->name('operative.configuration.update');
  Route::post('/integral/operative/planing/delete', 'SGOperativeController@deleteConfiguration')->name('operative.configuration.delete');
  // Programas
  Route::get('/integral/operative/programs', 'SGOperativeController@programsTo')->name('operative.programs');
  // Documentos
  Route::get('/integral/operative/documents', 'SGOperativeController@documentsTo')->name('operative.documents');
  // Formatos
  Route::get('/integral/operative/formats', 'SGOperativeController@formatsTo')->name('operative.formats');

  // INTEGRAL >> SG-MEJORA CONTINUA

  // Manual de funciones
  Route::get('/integral/improvement/hankbook', 'SGImprovementController@hankbookTo')->name('improvement.hankbook');
  Route::post('/integral/improvement/hankbook/save', 'SGImprovementController@saveDocumentimprovement')->name('improvement.document.save');
  Route::post('/integral/improvement/hankbook/update', 'SGImprovementController@updateDocumentimprovement')->name('improvement.document.update');
  Route::post('/integral/improvement/hankbook/delete', 'SGImprovementController@deleteDocumentimprovement')->name('improvement.document.delete');
  // Procedimientos
  Route::get('/integral/improvement/procedures', 'SGImprovementController@proceduresTo')->name('improvement.procedures');
  Route::post('/integral/improvement/procedures/save', 'SGImprovementController@saveVariableImprovement')->name('improvement.variable.save');
  Route::post('/integral/improvement/procedures/update', 'SGImprovementController@updateVariableImprovement')->name('improvement.variable.update');
  Route::post('/integral/improvement/procedures/delete', 'SGImprovementController@deleteVariableImprovement')->name('improvement.variable.delete');
  // Planeación
  Route::get('/integral/improvement/planning', 'SGImprovementController@planingTo')->name('improvement.planing');
  Route::post('/integral/improvement/planning/save', 'SGImprovementController@saveConfigImprovement')->name('improvement.configuration.save');
  Route::post('/integral/improvement/planning/update', 'SGImprovementController@updateConfigImprovement')->name('improvement.configuration.update');
  Route::post('/integral/improvement/planning/delete', 'SGImprovementController@deleteConfigImprovement')->name('improvement.configuration.delete');
  // Programas
  Route::get('/integral/improvement/programs', 'SGImprovementController@programsTo')->name('improvement.programs');
  // Documentos
  Route::get('/integral/improvement/documents', 'SGImprovementController@documentsTo')->name('improvement.documents');
  // Formatos
  Route::get('/integral/improvement/formats', 'SGImprovementController@formatsTo')->name('improvement.formats');

  // INTEGRAL >> SG-DOCUMENTAL

  // Manual de funciones
  Route::get('/integral/documentary/hankbook', 'SGDocumentaryController@hankbookTo')->name('documentary.hankbook');
  Route::post('/integral/documentary/hankbook/save', 'SGDocumentaryController@saveDocumentdocumentary')->name('documentary.document.save');
  Route::post('/integral/documentary/hankbook/update', 'SGDocumentaryController@updateDocumentdocumentary')->name('documentary.document.update');
  Route::post('/integral/documentary/hankbook/delete', 'SGDocumentaryController@deleteDocumentdocumentary')->name('documentary.document.delete');
  // Procedimientos
  Route::get('/integral/documentary/procedures', 'SGDocumentaryController@proceduresTo')->name('documentary.procedures');
  Route::post('/integral/documentary/procedures/save', 'SGDocumentaryController@saveVariableDocumentary')->name('documentary.variable.save');
  Route::post('/integral/documentary/procedures/update', 'SGDocumentaryController@updateVariableDocumentary')->name('documentary.variable.update');
  Route::post('/integral/documentary/procedures/delete', 'SGDocumentaryController@deleteVariableDocumentary')->name('documentary.variable.delete');
  // Planeación
  Route::get('/integral/documentary/planning', 'SGDocumentaryController@planingTo')->name('documentary.planing');
  Route::post('/integral/documentary/planning/save', 'SGDocumentaryController@saveConfigurationDocumentary')->name('documentary.configuration.save');
  Route::post('/integral/documentary/planning/update', 'SGDocumentaryController@updateConfigurationDocumentary')->name('documentary.configuration.update');
  Route::post('/integral/documentary/planning/delete', 'SGDocumentaryController@deleteConfigurationDocumentary')->name('documentary.configuration.delete');
  // Programas
  Route::get('/integral/documentary/programs', 'SGDocumentaryController@programsTo')->name('documentary.programs');
  // Documentos
  Route::get('/integral/documentary/documents', 'SGDocumentaryController@documentsTo')->name('documentary.documents');
  // Formatos
  Route::get('/integral/documentary/formats', 'SGDocumentaryController@formatsTo')->name('documentary.formats');
});

// RUTAS DEL MODULO LOGISTICA
Route::group(['middleware' => ['role:ADMINISTRADOR SISTEMA|ADMINISTRADOR']], function () {

  // LOGISTICA >> COLABORADORES

  // Creación de cargos
  Route::get('/logistic/collaborators/position', 'CollaboratorsController@positionTo')->name('collaborators.position');
  Route::post('/logistic/collaborators/position/save', 'CollaboratorsController@savePosition')->name('collaborators.position.save');
  Route::post('/logistic/collaborators/position/update', 'CollaboratorsController@updatePosition')->name('collaborators.position.update');
  Route::post('/logistic/collaborators/position/delete', 'CollaboratorsController@deletePosition')->name('collaborators.position.delete');
  // Manual de funciones
  Route::get('/logistic/collaborators/hankbook', 'CollaboratorsController@hankbookTo')->name('collaborators.hankbook');
  Route::post('/logistic/collaborators/hankbook/save', 'CollaboratorsController@saveHankbook')->name('collaborators.hankbook.save');
  Route::post('/logistic/collaborators/hankbook/update', 'CollaboratorsController@updateHankbook')->name('collaborators.hankbook.update');
  Route::post('/logistic/collaborators/hankbook/delete', 'CollaboratorsController@deleteHankbook')->name('collaborators.hankbook.delete');
  Route::get('/logistic/collaborators/hankbook/pdf', 'CollaboratorsController@pdfHandbook')->name('collaborators.hankbook.pdf');
  // Minuta de contrato
  Route::get('/logistic/collaborators/bill', 'CollaboratorsController@billTo')->name('collaborators.bill');
  Route::post('/logistic/collaborators/bill/save', 'CollaboratorsController@saveBill')->name('collaborators.bill.save');
  Route::post('/logistic/collaborators/bill/update', 'CollaboratorsController@updateBill')->name('collaborators.bill.update');
  Route::post('/logistic/collaborators/bill/delete', 'CollaboratorsController@deleteBill')->name('collaborators.bill.delete');
  Route::get('/logistic/collaborators/bill/pdf', 'CollaboratorsController@pdfBill')->name('collaborators.bill.pdf');
  Route::post('/logistic/collaborators/bill/aproved', 'CollaboratorsController@aprovedBill')->name('collaborators.bill.aproved');
  // Legalización de contrato
  Route::get('/logistic/collaborators/legalization', 'CollaboratorsController@legalizationTo')->name('collaborators.legalization');
  Route::post('/logistic/collaborators/legalization/save', 'CollaboratorsController@saveLegalization')->name('collaborators.legalization.save');
  Route::post('/logistic/collaborators/legalization/update', 'CollaboratorsController@updateLegalization')->name('collaborators.legalization.update');
  Route::post('/logistic/collaborators/legalization/delete', 'CollaboratorsController@deleteLegalization')->name('collaborators.legalization.delete');
  Route::get('/logistic/collaborators/legalization/pdf', 'CollaboratorsController@pdfLegalization')->name('collaborators.legalization.pdf');
  Route::post('/logistic/collaborators/legalization/finish', 'CollaboratorsController@finishLegalization')->name('collaborators.legalization.finish');
  // Afiliaciones seguridad social
  Route::get('/logistic/collaborators/affiliations', 'CollaboratorsController@affiliationsTo')->name('collaborators.affiliations');
  Route::post('/logistic/collaborators/affiliations/save', 'CollaboratorsController@saveAffiliation')->name('collaborators.affiliation.save');
  Route::post('/logistic/collaborators/affiliations/update', 'CollaboratorsController@updateAffiliation')->name('collaborators.affiliation.update');
  Route::post('/logistic/collaborators/affiliations/delete', 'CollaboratorsController@deleteAffiliation')->name('collaborators.affiliation.delete');
  // Entrega de dotaciónes
  Route::get('/logistic/collaborators/endowments', 'CollaboratorsController@endowmentsTo')->name('collaborators.endowments');
  Route::post('/logistic/collaborators/endowments/save', 'CollaboratorsController@saveEndowment')->name('collaborators.endowment.save');
  Route::post('/logistic/collaborators/endowments/update', 'CollaboratorsController@updateEndowment')->name('collaborators.endowment.update');
  Route::post('/logistic/collaborators/endowments/delete', 'CollaboratorsController@deleteEndowment')->name('collaborators.endowment.delete');
  Route::get('/logistic/collaborators/endowments/pdf', 'CollaboratorsController@pdfEndowment')->name('collaborators.endowment.pdf');
  // Entrega de equipos y herramientas
  Route::get('/logistic/collaborators/tools', 'CollaboratorsController@toolsTo')->name('collaborators.tools');
  Route::post('/logistic/collaborators/tools/save', 'CollaboratorsController@saveTool')->name('collaborators.tool.save');
  Route::post('/logistic/collaborators/tools/update', 'CollaboratorsController@updateTool')->name('collaborators.tool.update');
  Route::post('/logistic/collaborators/tools/delete', 'CollaboratorsController@deleteTool')->name('collaborators.tool.delete');
  Route::get('/logistic/collaborators/tools/pdf', 'CollaboratorsController@pdfTool')->name('collaborators.tool.pdf');
  // Notificaciónes
  Route::get('/logistic/collaborators/notifications', 'CollaboratorsController@notificationsTo')->name('collaborators.notifications');
  Route::post('/logistic/collaborators/notifications/save', 'CollaboratorsController@saveNotification')->name('collaborators.notification.save');
  Route::post('/logistic/collaborators/notifications/update', 'CollaboratorsController@updateNotification')->name('collaborators.notification.update');
  Route::post('/logistic/collaborators/notifications/delete', 'CollaboratorsController@deleteNotification')->name('collaborators.notification.delete');
  Route::get('/logistic/collaborators/notifications/pdf', 'CollaboratorsController@pdfNotification')->name('collaborators.notification.pdf');
  // Control de ausencia y ausentismo
  Route::get('/logistic/collaborators/control', 'CollaboratorsController@controlTo')->name('collaborators.control');
  Route::post('/logistic/collaborators/control/save', 'CollaboratorsController@saveControl')->name('collaborators.control.save');
  Route::post('/logistic/collaborators/control/update', 'CollaboratorsController@updateControl')->name('collaborators.control.update');
  Route::post('/logistic/collaborators/control/delete', 'CollaboratorsController@deleteControl')->name('collaborators.control.delete');
  Route::get('/logistic/collaborators/control/pdf', 'CollaboratorsController@pdfControl')->name('collaborators.control.pdf');
  // Control de asistencia a capacitaciónes
  Route::get('/logistic/collaborators/trainings', 'CollaboratorsController@trainingsTo')->name('collaborators.trainings');
  Route::post('/logistic/collaborators/trainings/save', 'CollaboratorsController@saveTraining')->name('collaborators.training.save');
  Route::post('/logistic/collaborators/trainings/update', 'CollaboratorsController@updateTraining')->name('collaborators.training.update');
  Route::post('/logistic/collaborators/trainings/delete', 'CollaboratorsController@deleteTraining')->name('collaborators.training.delete');
  Route::get('/logistic/collaborators/trainings/pdf', 'CollaboratorsController@pdfTraining')->name('collaborators.training.pdf');
  // Examenes médicos de ingreso
  Route::get('/logistic/collaborators/entranceexams', 'CollaboratorsController@entranceexamsTo')->name('collaborators.entranceexams');
  Route::post('/logistic/collaborators/entranceexams/save', 'CollaboratorsController@saveEntranceexam')->name('collaborators.entrance.save');
  Route::post('/logistic/collaborators/entranceexams/update', 'CollaboratorsController@updateEntranceexam')->name('collaborators.entrance.update');
  Route::post('/logistic/collaborators/entranceexams/delete', 'CollaboratorsController@deleteEntranceexam')->name('collaborators.entrance.delete');
  Route::get('/logistic/collaborators/entranceexams/pdf', 'CollaboratorsController@pdfEntranceexam')->name('collaborators.entrance.pdf');
  // Examenes médicos periódicos
  Route::get('/logistic/collaborators/examsperiods', 'CollaboratorsController@examsperiodsTo')->name('collaborators.examsperiods');
  Route::post('/logistic/collaborators/examsperiods/save', 'CollaboratorsController@saveExamsperiod')->name('collaborators.examperiod.save');
  Route::post('/logistic/collaborators/examsperiods/update', 'CollaboratorsController@updateExamsperiod')->name('collaborators.examperiod.update');
  Route::post('/logistic/collaborators/examsperiods/delete', 'CollaboratorsController@deleteExamsperiod')->name('collaborators.examperiod.delete');
  Route::get('/logistic/collaborators/examsperiods/pdf', 'CollaboratorsController@pdfExamsperiod')->name('collaborators.examperiod.pdf');
  // Examenes médicos de egreso
  Route::get('/logistic/collaborators/exitexams', 'CollaboratorsController@exitexamsTo')->name('collaborators.exitexams');
  Route::post('/logistic/collaborators/exitexams/save', 'CollaboratorsController@saveExitexam')->name('collaborators.exit.save');
  Route::post('/logistic/collaborators/exitexams/update', 'CollaboratorsController@updateExitexam')->name('collaborators.exit.update');
  Route::post('/logistic/collaborators/exitexams/delete', 'CollaboratorsController@deleteExitexam')->name('collaborators.exit.delete');
  Route::get('/logistic/collaborators/exitexams/pdf', 'CollaboratorsController@pdfExitexam')->name('collaborators.exit.pdf');
  // Evaluaciones de desempeño
  Route::get('/logistic/collaborators/tests', 'CollaboratorsController@testsTo')->name('collaborators.tests');

  // LOGISTICA >> CONTRATISTAS

  // Manual de funciones
  Route::get('/logistic/contractors/handbook', 'ContractorsController@handbookTo')->name('contractors.handbook');
  Route::post('/logistic/contractors/handbook/save', 'ContractorsController@saveHandbook')->name('contractors.handbook.save');
  Route::post('/logistic/contractors/handbook/update', 'ContractorsController@updateHandbook')->name('contractors.handbook.update');
  Route::post('/logistic/contractors/handbook/delete', 'ContractorsController@deleteHandbook')->name('contractors.handbook.delete');
  Route::get('/logistic/contractors/handbook/pdf', 'ContractorsController@pdfHandbook')->name('contractors.handbook.pdf');
  // Minuta de contrato
  Route::get('/logistic/contractors/bill', 'ContractorsController@billTo')->name('contractors.bill');
  Route::post('/logistic/contractors/bill/save', 'ContractorsController@saveBill')->name('contractors.bill.save');
  Route::post('/logistic/contractors/bill/update', 'ContractorsController@updateBill')->name('contractors.bill.update');
  Route::post('/logistic/contractors/bill/delete', 'ContractorsController@deleteBill')->name('contractors.bill.delete');
  Route::get('/logistic/contractors/bill/pdf', 'ContractorsController@pdfBill')->name('contractors.bill.pdf');
  Route::post('/logistic/contractors/bill/aproved', 'ContractorsController@aprovedBill')->name('contractors.bill.aproved');
  // Legalización de contrato
  Route::get('/logistic/contractors/legalization', 'ContractorsController@legalizationTo')->name('contractors.legalization');
  Route::get('/logistic/contractors/legalization/pdf', 'ContractorsController@pdfLegalization')->name('contractors.legalization.pdf');
  Route::post('/logistic/contractors/legalization/finish', 'ContractorsController@finishLegalization')->name('contractors.legalization.finish');
  // Convenio colaboración empresarial
  Route::get('/logistic/contractors/agreement', 'ContractorsController@agreementTo')->name('contractors.agreement');
  Route::post('/logistic/contractors/agreement/save', 'ContractorsController@saveAgreement')->name('contractors.agreement.save');
  Route::post('/logistic/contractors/agreement/update', 'ContractorsController@updateAgreement')->name('contractors.agreement.update');
  Route::post('/logistic/contractors/agreement/delete', 'ContractorsController@deleteAgreement')->name('contractors.agreement.delete');
  Route::get('/logistic/contractors/agreement/pdf', 'ContractorsController@pdfAgreement')->name('contractors.agreement.pdf');
  // Seguimiento seguridad social
  Route::get('/logistic/contractors/tracking', 'ContractorsController@trackingTo')->name('contractors.tracking');
  Route::post('/logistic/contractors/tracking/save', 'ContractorsController@saveTracking')->name('contractors.tracking.save');
  Route::post('/logistic/contractors/tracking/update', 'ContractorsController@updateTracking')->name('contractors.tracking.update');
  Route::post('/logistic/contractors/tracking/delete', 'ContractorsController@deleteTracking')->name('contractors.tracking.delete');
  Route::get('/logistic/contractors/tracking/pdf', 'ContractorsController@pdfTracking')->name('contractors.tracking.pdf');
  // Notificaciones
  Route::get('/logistic/contractors/notifications', 'ContractorsController@notificationsTo')->name('contractors.notifications');
  Route::post('/logistic/contractors/notifications/save', 'ContractorsController@saveNotification')->name('contractors.notification.save');
  Route::post('/logistic/contractors/notifications/update', 'ContractorsController@updateNotification')->name('contractors.notification.update');
  Route::post('/logistic/contractors/notifications/delete', 'ContractorsController@deleteNotification')->name('contractors.notification.delete');
  Route::get('/logistic/contractors/notifications/pdf', 'ContractorsController@pdfNotification')->name('contractors.notification.pdf');
  // Control de ausencia y ausentismo
  Route::get('/logistic/contractors/control', 'ContractorsController@controlTo')->name('contractors.control');
  Route::post('/logistic/contractors/control/save', 'ContractorsController@saveControl')->name('contractors.control.save');
  Route::post('/logistic/contractors/control/update', 'ContractorsController@updateControl')->name('contractors.control.update');
  Route::post('/logistic/contractors/control/delete', 'ContractorsController@deleteControl')->name('contractors.control.delete');
  Route::get('/logistic/contractors/control/pdf', 'ContractorsController@pdfControl')->name('contractors.control.pdf');
  // Control de asistencia a capacitaciónes
  Route::get('/logistic/contractors/trainings', 'ContractorsController@trainingsTo')->name('contractors.trainings');
  Route::post('/logistic/contractors/trainings/save', 'ContractorsController@saveTraining')->name('contractors.training.save');
  Route::post('/logistic/contractors/trainings/update', 'ContractorsController@updateTraining')->name('contractors.training.update');
  Route::post('/logistic/contractors/trainings/delete', 'ContractorsController@deleteTraining')->name('contractors.training.delete');
  Route::get('/logistic/contractors/trainings/pdf', 'ContractorsController@pdfTraining')->name('contractors.training.pdf');
  // Evaluaciones de desempeño
  Route::get('/logistic/contractors/tests', 'ContractorsController@testsTo')->name('contractors.tests');
  // Activaciones del sistema
  Route::get('/logistic/contractors/activations', 'ContractorsController@activationsTo')->name('contractors.activations');
  Route::post('/logistic/contractors/activations/save', 'ContractorsController@saveActivation')->name('contractors.activation.save');
  Route::post('/logistic/contractors/activations/update', 'ContractorsController@updateActivation')->name('contractors.activation.update');
  Route::post('/logistic/contractors/activations/delete', 'ContractorsController@deleteActivation')->name('contractors.activation.delete');

  // LOGISTICA >> PROVEEDORES

  // Minuta de contrato
  Route::get('/logistic/providers/bill', 'LProvidersController@billTo')->name('providers.bill');
  Route::post('/logistic/providers/bill/save', 'LProvidersController@saveBill')->name('providers.bill.save');
  Route::post('/logistic/providers/bill/update', 'LProvidersController@updateBill')->name('providers.bill.update');
  Route::post('/logistic/providers/bill/delete', 'LProvidersController@deleteBill')->name('providers.bill.delete');
  Route::get('/logistic/providers/bill/pdf', 'LProvidersController@pdfBill')->name('providers.bill.pdf');
  Route::post('/logistic/providers/bill/aproved', 'LProvidersController@aprovedBill')->name('providers.bill.aproved');
  // Legalización de contrato
  Route::get('/logistic/providers/legalization', 'LProvidersController@legalizationTo')->name('providers.legalization');
  Route::get('/logistic/providers/legalization/pdf', 'LProvidersController@pdfLegalization')->name('providers.legalization.pdf');
  Route::post('/logistic/providers/legalization/finish', 'LProvidersController@finishLegalization')->name('providers.legalization.finish');
  // Notificaciones
  Route::get('/logistic/providers/notifications', 'LProvidersController@notificationsTo')->name('providers.notifications');
  Route::post('/logistic/providers/notifications/save', 'LProvidersController@saveNotification')->name('providers.notification.save');
  Route::post('/logistic/providers/notifications/update', 'LProvidersController@updateNotification')->name('providers.notification.update');
  Route::post('/logistic/providers/notifications/delete', 'LProvidersController@deleteNotification')->name('providers.notification.delete');
  Route::get('/logistic/providers/notifications/pdf', 'LProvidersController@pdfNotification')->name('providers.notification.pdf');
  // Evaluaciones de desempeño
  Route::get('/logistic/providers/tests', 'LProvidersController@testsTo')->name('providers.tests');
  // Orden de compra
  Route::get('/logistic/providers/order', 'LProvidersController@orderTo')->name('providers.order');
  Route::post('/logistic/providers/order/save', 'LProvidersController@saveOrder')->name('providers.order.save');
  Route::post('/logistic/providers/order/update', 'LProvidersController@updateOrder')->name('providers.order.update');
  Route::post('/logistic/providers/order/cancel', 'LProvidersController@cancelOrder')->name('providers.order.cancel');
  Route::post('/logistic/providers/order/qualify', 'LProvidersController@qualifyOrder')->name('providers.order.qualify');
  Route::get('/logistic/providers/order/pdf', 'LProvidersController@pdfOrder')->name('providers.order.pdf');

  // LOGISTICA >> PROGRAMAS

  // Reposición del parque automotor
  Route::get('/logistic/programs/replacement', 'ProgramsController@replacementTo')->name('programs.replacement');
  Route::post('/logistic/programs/new-replacement', 'ProgramsController@replacementSave')->name('replacement.save');
  Route::post('/logistic/programs/pdf-replacement', 'ProgramsController@replacementPDF')->name('replacement.pdf');
  Route::get('/logistic/archives/replacement', 'ProgramsController@replacementArchive')->name('archive.replacement');
  Route::patch('/logistic/archives/update-replacement', 'ProgramsController@replacementUpdate')->name('update.replacement');
  Route::delete('/logistic/archives/delete-replacement', 'ProgramsController@replacementDelete')->name('delete.replacement');
  // Control de Infracciones a las normas de tránsito
  Route::get('/logistic/programs/control', 'ProgramsController@controlTo')->name('programs.control');
  Route::post('/logistic/programs/new-control', 'ProgramsController@controlSave')->name('control.save');
  Route::post('/logistic/programs/pdf-control', 'ProgramsController@controlPDF')->name('control.pdf');
  Route::get('/logistic/archives/control', 'ProgramsController@controlArchive')->name('archive.control');
  Route::patch('/logistic/archives/update-control', 'ProgramsController@controlUpdate')->name('update.control');
  Route::delete('/logistic/archives/delete-control', 'ProgramsController@controlDelete')->name('delete.control');
  // Informe de Control y análisis de accidentes
  Route::get('/logistic/programs/report', 'ProgramsController@reportTo')->name('programs.report');
  Route::post('/logistic/programs/new-report', 'ProgramsController@reportSave')->name('report.save');
  Route::post('/logistic/programs/pdf-report', 'ProgramsController@reportPDF')->name('report.pdf');
  Route::get('/logistic/archives/report', 'ProgramsController@reportArchive')->name('archive.report');
  Route::patch('/logistic/archives/update-report', 'ProgramsController@reportUpdate')->name('update.report');
  Route::delete('/logistic/archives/delete-report', 'ProgramsController@reportDelete')->name('delete.report');
  // Procedimientos de atención de usuarios
  Route::get('/logistic/programs/procedures', 'ProgramsController@proceduresTo')->name('programs.procedures');
  Route::post('/logistic/programs/new-procedures', 'ProgramsController@proceduresSave')->name('procedures.save');
  Route::post('/logistic/programs/pdf-procedures', 'ProgramsController@proceduresPDF')->name('procedures.pdf');
  Route::get('/logistic/archives/procedures', 'ProgramsController@proceduresArchive')->name('archive.procedures');
  Route::patch('/logistic/archives/update-procedures', 'ProgramsController@proceduresUpdate')->name('update.procedures');
  Route::delete('/logistic/archives/delete-procedures', 'ProgramsController@proceduresDelete')->name('delete.procedures');
  // Sistema de Comunicación Bidireccional
  Route::get('/logistic/programs/comunications', 'ProgramsController@comunicationsTo')->name('programs.comunications');
  Route::post('/logistic/programs/new-comunications', 'ProgramsController@comunicationsSave')->name('comunications.save');
  Route::post('/logistic/programs/pdf-comunications', 'ProgramsController@comunicationsPDF')->name('comunications.pdf');
  Route::get('/logistic/archives/comunications', 'ProgramsController@comunicationsArchive')->name('archive.comunications');
  Route::patch('/logistic/archives/update-comunications', 'ProgramsController@comunicationsUpdate')->name('update.comunications');
  Route::delete('/logistic/archives/delete-comunications', 'ProgramsController@comunicationsDelete')->name('delete.comunications');
  // Revisión de mantenimiento preventivo
  Route::get('/logistic/programs/maintenance', 'ProgramsController@maintenanceTo')->name('programs.maintenance');
  Route::post('/logistic/programs/new-maintenance', 'ProgramsController@maintenanceSave')->name('maintenance.save');
  Route::post('/logistic/programs/pdf-maintenance', 'ProgramsController@maintenancePDF')->name('maintenance.pdf');
  Route::get('/logistic/archives/maintenance', 'ProgramsController@maintenanceArchive')->name('archive.maintenance');
  Route::patch('/logistic/archives/update-maintenance', 'ProgramsController@maintenanceUpdate')->name('update.maintenance');
  Route::delete('/logistic/archives/delete-maintenance', 'ProgramsController@maintenanceDelete')->name('delete.maintenance');
});
