$(document).ready(function () {

  /*if ($('#validateAuthColor').val() == 'Autenticado'){
    $('body').css('background','#fff');
    $('header').css('background','#fff');
  }
  if(($('#validateAuthColor').val() == 'Ausente')){
    $('body').css('background','#ccc');
    $('header').css('background','#ccc');
  }*/

  //Cargando datatables en tablas
  loadDatatables();

  //Cargando inputs con calendario
  $('.datepicker').datepicker({
    format: "yyyy-mm-dd",
    language: "es",
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    autoclose: true
  });


  $('.bj-header-submenu').click(function () {
    $(this).find('ul').slideToggle();
  });
  $('.bj-header-submenu ul').click(function (e) {
    e.stopPropagation();
  });

  var direccionActual = $('.directionUri').html();
  $('.directionUri').html(seeDirection(direccionActual));
});

function seeDirection($direction = '/home') {

  switch ($direction) {
    case '/opensoft/home':
      return 'INICIO';
      break;

    /*================================================
        CONFIGURACION
    ================================================*/

    // CONFIGURACION >> ACCESO
    case '/opensoft/setting/access/roles':
      return 'CONFIGURACION >> ACCESO >> ROLES';
      break;
    case '/opensoft/setting/access/permissions':
      return 'CONFIGURACION >> ACCESO >> PERMISOS';
      break;
    case '/opensoft/setting/access/users':
      return 'CONFIGURACION >> ACCESO >> USUARIOS';
      break;

    // CONFIGURACION >> LUGARES
    case '/opensoft/setting/places/departments':
      return 'CONFIGURACION >> LUGARES >> DEPARTAMENTOS';
      break;
    case '/opensoft/setting/places/municipalities':
      return 'CONFIGURACION >> LUGARES >> MUNICIPIOS';
      break;
    case '/opensoft/setting/places/zoning':
      return 'CONFIGURACION >> LUGARES >> ZONIFICACION';
      break;
    case '/opensoft/setting/places/neighborhoods':
      return 'CONFIGURACION >> LUGARES >> BARRIOS';
      break;

    // CONFIGURACION >> SEGURIDAD SOCIAL
    case '/opensoft/setting/security/health':
      return 'CONFIGURACION >> SEGURIDAD SOCIAL >> ENTIDAD PROMOTORA DE SALUD';
      break;
    case '/opensoft/setting/security/pensions':
      return 'CONFIGURACION >> SEGURIDAD SOCIAL >> FONDO DE PENSIONES';
      break;
    case '/opensoft/setting/security/layoffs':
      return 'CONFIGURACION >> SEGURIDAD SOCIAL >> FONDO DE CESANTIAS';
      break;
    case '/opensoft/setting/security/risks':
      return 'CONFIGURACION >> SEGURIDAD SOCIAL >> ADMINISTRADORA DE RIESGOS LABORALES';
      break;
    case '/opensoft/setting/security/compensations':
      return 'CONFIGURACION >> SEGURIDAD SOCIAL >> CAJAS DE COMPENSACION';
      break;

    // CONFIGURACION >> DOCUMENTOS
    case '/opensoft/setting/documents/personal':
      return 'CONFIGURACION >> DOCUMENTOS >> IDENTIFICACION PERSONAL';
      break;
    case '/opensoft/setting/documents/driving':
      return 'CONFIGURACION >> DOCUMENTOS >> LICENCIAS DE CONDUCCION';
      break;
    case '/opensoft/setting/documents/courses':
      return 'CONFIGURACION >> DOCUMENTOS >> CURSOS CERTIFICADOS';
      break;
    case '/opensoft/setting/documents/insurances':
      return 'CONFIGURACION >> DOCUMENTOS >> POLIZAS Y SEGUROS';
      break;
    case '/opensoft/setting/documents/legalization':
      return 'CONFIGURACION >> DOCUMENTOS >> LEGALIZACION DE VEHICULOS';
      break;

    // CONFIGURACION >> TIPOS DE VEHICULOS
    case '/opensoft/setting/vehicle/motorcycles':
      return 'CONFIGURACION >> TIPOS DE VEHICULOS >> MOTOCICLETAS';
      break;
    case '/opensoft/setting/vehicle/heavy':
      return 'CONFIGURACION >> TIPOS DE VEHICULOS >> CARGA';
      break;
    case '/opensoft/setting/vehicle/especial':
      return 'CONFIGURACION >> TIPOS DE VEHICULOS >> ESPECIAL';
      break;

    // CONFIGURACION >> TIPOS DE PRODUCTOS
    case '/opensoft/setting/products/messenger':
      return 'CONFIGURACION >> TIPOS DE PRODUCTOS >> MENSAJERIA EXPRESS';
      break;
    case '/opensoft/setting/products/logistic':
      return 'CONFIGURACION >> TIPOS DE PRODUCTOS >> LOGISTICA EXPRESS';
      break;
    case '/opensoft/setting/products/express':
      return 'CONFIGURACION >> TIPOS DE PRODUCTOS >> CARGA EXPRESS';
      break;
    case '/opensoft/setting/products/tourism':
      return 'CONFIGURACION >> TIPOS DE PRODUCTOS >> TURISMO PASAJEROS';
      break;
    case '/opensoft/setting/products/transfers':
      return 'CONFIGURACION >> TIPOS DE PRODUCTOS >> TRASLADOS URBANOS';
      break;
    case '/opensoft/setting/products/transfersmunicipals':
      return 'CONFIGURACION >> TIPOS DE PRODUCTOS >> TRASLADOS INTERMUNICIPALES';
      break;

    // CONFIGURACION >> TIPOS DE SERVICIOS
    case '/opensoft/setting/services/messenger':
      return 'CONFIGURACION >> TIPOS DE SERVICIOS >> MENSAJERIA EXPRESS';
      break;
    case '/opensoft/setting/services/logistic':
      return 'CONFIGURACION >> TIPOS DE SERVICIOS >> LOGISTICA EXPRESS';
      break;
    case '/opensoft/setting/services/express':
      return 'CONFIGURACION >> TIPOS DE SERVICIOS >> CARGA EXPRESS';
      break;
    case '/opensoft/setting/services/tourism':
      return 'CONFIGURACION >> TIPOS DE SERVICIOS >> TURISMO PASAJEROS';
      break;
    case '/opensoft/setting/services/transfers':
      return 'CONFIGURACION >> TIPOS DE SERVICIOS >> TRASLADOS URBANOS';
      break;
    case '/opensoft/setting/services/transfersmunicipals':
      return 'CONFIGURACION >> TIPOS DE SERVICIOS >> TRASLADOS INTERMUNICIPALES';
      break;

    /*================================================
        ADMINISTRATIVA
    ================================================*/

    // ADMINISTRATIVA >> CONFIGURACION DE EMPRESA
    case '/opensoft/administrative/company/legal':
      return 'ADMINISTRATIVA >> CONFIGURACION DE EMPRESA >> INFORMACION JURIDICA';
      break;
    case '/opensoft/administrative/company/financial':
      return 'ADMINISTRATIVA >> CONFIGURACION DE EMPRESA >> INFORMACION FINANCIERA';
      break;
    case '/opensoft/administrative/company/technical':
      return 'ADMINISTRATIVA >> CONFIGURACION DE EMPRESA >> INFORMACION TECNICA';
      break;

    // ADMINISTRATIVA >> CONFIGURACION RECURSOS HUMANOS
    case '/opensoft/administrative/humans/collaborators':
      return 'ADMINISTRATIVA >> CONFIGURACION RECURSOS HUMANOS >> COLABORADORES';
      break;
    case '/opensoft/administrative/humans/contractorsMessenger':
      return 'ADMINISTRATIVA >> CONFIGURACION RECURSOS HUMANOS >> CONTRATISTAS MENSAJERIA';
      break;
    case '/opensoft/administrative/humans/contractorsExpress':
      return 'ADMINISTRATIVA >> CONFIGURACION RECURSOS HUMANOS >> CONTRATISTAS CARGA EXPRESS';
      break;
    case '/opensoft/administrative/humans/contractorsEspecial':
      return 'ADMINISTRATIVA >> CONFIGURACION RECURSOS HUMANOS >> CONTRATISTAS SERVICIOS ESPECIALES';
      break;

    // ADMINISTRATIVA >> CONFIGURACION PROVEEDORES
    case '/opensoft/administrative/providers/products':
      return 'ADMINISTRATIVA >> CONFIGURACION PROVEEDORES >> PRODUCTOS';
      break;
    case '/opensoft/administrative/providers/services':
      return 'ADMINISTRATIVA >> CONFIGURACION PROVEEDORES >> SERVICIOS';
      break;
    case '/opensoft/administrative/providers/providers':
      return 'ADMINISTRATIVA >> CONFIGURACION PROVEEDORES >> PROVEEDORES';
      break;

    // ADMINISTRATIVA >> CONFIGURACION EMPRESAS ALIADAS
    case '/opensoft/administrative/allies/messengers':
      return 'ADMINISTRATIVA >> CONFIGURACION EMPRESAS ALIADAS >> MENSAJERIA';
      break;
    case '/opensoft/administrative/allies/express':
      return 'ADMINISTRATIVA >> CONFIGURACION EMPRESAS ALIADAS >> CARGA EXPRESS';
      break;
    case '/opensoft/administrative/allies/services':
      return 'ADMINISTRATIVA >> CONFIGURACION EMPRESAS ALIADAS >> SERVICIOS ESPECIALES';
      break;

    // ADMINISTRATIVA >> CONFIGURACION PARQUE AUTOMOTOR
    case '/opensoft/administrative/automotors/messengers':
      return 'ADMINISTRATIVA >> CONFIGURACION PARQUE AUTOMOTOR >> MENSAJERIA';
      break;
    case '/opensoft/administrative/automotors/express':
      return 'ADMINISTRATIVA >> CONFIGURACION PARQUE AUTOMOTOR >> CARGA EXPRESS';
      break;
    case '/opensoft/administrative/automotors/services':
      return 'ADMINISTRATIVA >> CONFIGURACION PARQUE AUTOMOTOR >> SERVICIOS ESPECIALES';
      break;

    /*================================================
        COMERCIAL
    ================================================*/

    // COMERCIAL >> PORTAFOLIO DE SERVICIOS
    case '/opensoft/comercial/tariffs/messenger':
      return 'COMERCIAL >> PORTAFOLIO DE SERVICIOS >> MENSAJERIA EXPRESS';
      break;
    case '/opensoft/comercial/tariffs/logistic':
      return 'COMERCIAL >> PORTAFOLIO DE SERVICIOS >> LOGISTICA EXPRESS';
      break;
    case '/opensoft/comercial/tariffs/charge':
      return 'COMERCIAL >> PORTAFOLIO DE SERVICIOS >> CARGA EXPRESS';
      break;
    case '/opensoft/comercial/tariffs/service':
      return 'COMERCIAL >> PORTAFOLIO DE SERVICIOS >> SERVICIO ESPECIAL';
      break;
    case '/opensoft/comercial/tariffs/turism':
      return 'COMERCIAL >> PORTAFOLIO DE SERVICIOS >> TURISMO PASAJEROS';
      break;
    case '/opensoft/comercial/tariffs/transfer':
      return 'COMERCIAL >> PORTAFOLIO DE SERVICIOS >> TRASLADO URBANO';
      break;
    case '/opensoft/comercial/tariffs/transferintermunipality':
      return 'COMERCIAL >> PORTAFOLIO DE SERVICIOS >> TRASLADO INTERMUNICIPAL';
      break;

    // COMERCIAL >> PLAN DE MERCADEO
    case '/opensoft/comercial/marketing/opportunity':
      return 'COMERCIAL >> PLAN DE MERCADEO >> OPORTUNIDAD DE NEGOCIOS';
      break;
    case '/opensoft/comercial/marketing/tracking':
      return 'COMERCIAL >> PLAN DE MERCADEO >> SEGUIMIENTO DE NEGOCIOS';
      break;
    case '/opensoft/comercial/marketing/records':
      return 'COMERCIAL >> PLAN DE MERCADEO >> ARCHIVO DE NEGOCIOS';
      break;
    case '/opensoft/comercial/marketing/statistic':
      return 'COMERCIAL >> PLAN DE MERCADEO >> ESTADISTICA';
      break;

    // COMERCIAL >> CLIENTE POTENCIAL
    case '/opensoft/comercial/clients/bidding':
      return 'COMERCIAL >> CLIENTE POTENCIAL >> LICITACIONES PUBLICAS';
      break;
    case '/opensoft/comercial/clients/proposal':
      return 'COMERCIAL >> CLIENTE POTENCIAL >> PROPUESTA COMERCIAL';
      break;
    case '/opensoft/comercial/clients/tracking':
      return 'COMERCIAL >> CLIENTE POTENCIAL >> SEGUIMIENTO COMERCIAL';
      break;
    case '/opensoft/comercial/clients/records':
      return 'COMERCIAL >> CLIENTE POTENCIAL >> ARCHIVO COMERCIAL';
      break;
    case '/opensoft/comercial/clients/statistic':
      return 'COMERCIAL >> CLIENTE POTENCIAL >> ESTADISTICA';
      break;

    // COMERCIAL >> CONTRATOS PERMANENTES
    case '/opensoft/comercial/permanent/clients':
      return 'COMERCIAL >> CONTRATOS PERMANENTES >> CLIENTES';
      break;
    case '/opensoft/comercial/permanent/legalizations':
      return 'COMERCIAL >> CONTRATOS PERMANENTES >> LEGALIZACION CONTRACTUAL';
      break;
    case '/opensoft/comercial/permanent/conditions':
      return 'COMERCIAL >> CONTRATOS PERMANENTES >> CONDICIONES ECONOMICAS';
      break;
    case '/opensoft/comercial/permanent/records':
      return 'COMERCIAL >> CONTRATOS PERMANENTES >> ARCHIVO DE CONTRATOS';
      break;
    case '/opensoft/comercial/permanent/statistic':
      return 'COMERCIAL >> CONTRATOS PERMANENTES >> ESTADISTICA';
      break;

    // COMERCIAL >> CONTRATOS OCASIONALES
    case '/opensoft/comercial/occasional/orders':
      return 'COMERCIAL >> CONTRATOS OCASIONALES >> ORDEN DE SERVICIO';
      break;
    case '/opensoft/comercial/occasional/trackings':
      return 'COMERCIAL >> CONTRATOS OCASIONALES >> SEGUIMIENTO DE SERVICIO CARGA EXPRESS';
      break;
    case '/opensoft/comercial/occasional/services':
      return 'COMERCIAL >> CONTRATOS OCASIONALES >> SERVICIO ESPECIAL';
      break;

    /*================================================
        OPERATIVO
    ================================================*/

    // OPERATIVO >> SOLICITUD DE SERVICIOS
    case '/opensoft/operative/request/messenger':
      return 'OPERATIVA >> SOLICITUD DE SERVICIOS >> MENSAJERIA EXPRESS';
      break;
    case '/opensoft/operative/request/logistic':
      return 'OPERATIVA >> SOLICITUD DE SERVICIOS >> LOGISTICA EXPRESS';
      break;
    case '/opensoft/operative/request/charge':
      return 'OPERATIVA >> SOLICITUD DE SERVICIOS >> CARGA EXPRESS';
      break;
    case '/opensoft/operative/request/service':
      return 'OPERATIVA >> SOLICITUD DE SERVICIOS >> SERVICIO ESPECIAL';
      break;
    case '/opensoft/operative/request/turism':
      return 'OPERATIVA >> SOLICITUD DE SERVICIOS >> TURISMO PASAJEROS';
      break;
    case '/opensoft/operative/request/transfer':
      return 'OPERATIVA >> SOLICITUD DE SERVICIOS >> TRASLADO URBANO';
      break;
    case '/opensoft/operative/request/transferintermunicipal':
      return 'OPERATIVA >> SOLICITUD DE SERVICIOS >> TRASLADO INTERMUNICIPAL';
      break;

    // OPERATIVO >> PROGRAMACION DE SERVICIOS
    case '/opensoft/operative/programming/assignment':
      return 'OPERATIVA >> PROGRAMACION DE SERVICIOS >> ASIGNACION OPERADOR';
      break;
    case '/opensoft/operative/programming/acceptance':
      return 'OPERATIVA >> PROGRAMACION DE SERVICIOS >> ACEPTACION OPERADOR';
      break;
    case '/opensoft/operative/programming/report':
      return 'OPERATIVA >> PROGRAMACION DE SERVICIOS >> INFORME DE SERVICIO';
      break;

    // OPERATIVO >> SEGUIMIENTO DE SERVICIOS
    case '/opensoft/operative/tracking/confirmation':
      return 'OPERATIVA >> SEGUIMIENTO DE SERVICIOS >> CONFIRMACION OPERADOR';
      break;
    case '/opensoft/operative/tracking/start':
      return 'OPERATIVA >> SEGUIMIENTO DE SERVICIOS >> INICIO DE SERVICIO';
      break;
    case '/opensoft/operative/tracking/running':
      return 'OPERATIVA >> SEGUIMIENTO DE SERVICIOS >> SERVICIO EN EJECUCION';
      break;
    case '/opensoft/operative/tracking/finalized':
      return 'OPERATIVA >> SEGUIMIENTO DE SERVICIOS >> SERVICIOS FINALIZADOS';
      break;

    // OPERATIVO >> LIQUIDACION DE SERVICIOS
    case '/opensoft/operative/settlement/clients':
      return 'OPERATIVA >> LIQUIDACION DE SERVICIOS >> LIQUIDACION PARA CLIENTES';
      break;
    case '/opensoft/operative/settlement/operators':
      return 'OPERATIVA >> LIQUIDACION DE SERVICIOS >> LIQUIDACION PARA OPERADORES';
      break;

    // OPERATIVO >> CALIFICACION DE SERVICIOS
    case '/opensoft/operative/qualification/users':
      return 'OPERATIVA >> CALIFICACION DE SERVICIOS >> CALIFICACION DEL USUARIO';
      break;
    case '/opensoft/operative/qualification/operators':
      return 'OPERATIVA >> CALIFICACION DE SERVICIOS >> CALIFICACION DEL OPERADOR';
      break;
    case '/opensoft/operative/qualification/statistic':
      return 'OPERATIVA >> CALIFICACION DE SERVICIOS >> ESTADISTICA';
      break;

    /*================================================
        FINANCIERA
    ================================================*/

    // FINANCIERA >> CUENTAS POR COBRAR
    case '/opensoft/financial/account/receivable':
      return 'FINANCIERA >> CUENTAS POR COBRAR';
      break;

    // FINANCIERA >> CUENTAS POR PAGAR
    case '/opensoft/financial/account/pay':
      return 'FINANCIERA >> CUENTAS POR PAGAR';
      break;

    // FINANCIERA >> MOVIMIENTO DE INGRESOS
    case '/opensoft/financial/entrys/facturation':
      return 'FINANCIERA >> MOVIMIENTO DE INGRESOS >> FACTURACION DE VENTA';
      break;
    case '/opensoft/financial/entrys/wallet':
      return 'FINANCIERA >> MOVIMIENTO DE INGRESOS >> CARTERA VENCIDA';
      break;
    case '/opensoft/financial/entrys/voucher':
      return 'FINANCIERA >> MOVIMIENTO DE INGRESOS >> COMPROBANTES DE INGRESO';
      break;
    case '/opensoft/financial/entrys/statistic':
      return 'FINANCIERA >> MOVIMIENTO DE INGRESOS >> ESTADISTICAS DE VENTA';
      break;

    // FINANCIERA >> MOVIMIENTO DE EGRESOS
    case '/opensoft/financial/egress/accounts':
      return 'FINANCIERA >> MOVIMIENTO DE EGRESOS >> CUENTAS POR PAGAR';
      break;
    case '/opensoft/financial/egress/obligations':
      return 'FINANCIERA >> MOVIMIENTO DE EGRESOS >> OBLIGACIONES VENCIDAS';
      break;
    case '/opensoft/financial/egress/vouchers':
      return 'FINANCIERA >> MOVIMIENTO DE EGRESOS >> COMPROBANTES DE EGRESO';
      break;
    case '/opensoft/financial/egress/statistic':
      return 'FINANCIERA >> MOVIMIENTO DE EGRESOS >> ESTADISTICAS DE GASTOS';
      break;

    // FINANCIERA >> ANALISIS DE PROSUPUESTO
    case '/opensoft/financial/analysis/conciliation':
      return 'FINANCIERA >> ANALISIS DE PROSUPUESTO >> CONCILIACION DE SALDOS';
      break;
    case '/opensoft/financial/analysis/structure':
      return 'FINANCIERA >> ANALISIS DE PROSUPUESTO >> ESTRUCTURA DE COSTOS';
      break;
    case '/opensoft/financial/analysis/description':
      return 'FINANCIERA >> ANALISIS DE PROSUPUESTO >> DESCRIPCION DE COSTOS';
      break;
    case '/opensoft/financial/analysis/budget':
      return 'FINANCIERA >> ANALISIS DE PROSUPUESTO >> PRESUPUESTO ANUAL';
      break;
    case '/opensoft/financial/analysis/tracking':
      return 'FINANCIERA >> ANALISIS DE PROSUPUESTO >> SEGUIMIENTO MENSUAL';
      break;
    case '/opensoft/financial/analysis/report':
      return 'FINANCIERA >> ANALISIS DE PROSUPUESTO >> INFORME DE CIERRE';
      break;

    /*================================================
        SISTEMAS
    ================================================*/

    // SISTEMAS >> SG-GERENCIAL
    case '/opensoft/integral/managerial/hankbook':
      return 'SISTEMAS >> SG-GERENCIAL >> CREACION DE DOCUMENTOS';
      break;
    case '/opensoft/integral/managerial/procedures':
      return 'SISTEMAS >> SG-GERENCIAL >> CREACION DE VARIABLES';
      break;
    case '/opensoft/integral/managerial/planning':
      return 'SISTEMAS >> SG-GERENCIAL >> CONFIGURACION DOCUMENTO';
      break;
    case '/opensoft/integral/managerial/programs':
      return 'SISTEMAS >> SG-GERENCIAL >> PROGRAMAS';
      break;
    case '/opensoft/integral/managerial/documents':
      return 'SISTEMAS >> SG-GERENCIAL >> DOCUMENTOS';
      break;
    case '/opensoft/integral/managerial/formats':
      return 'SISTEMAS >> SG-GERENCIAL >> FORMATOS';
      break;

    // SISTEMAS >> SG-LOGISTICA
    case '/opensoft/integral/logistic/hankbook':
      return 'SISTEMAS >> SG-LOGISTICA >> CREACION DE DOCUMENTOS';
      break;
    case '/opensoft/integral/logistic/procedures':
      return 'SISTEMAS >> SG-LOGISTICA >> CREACION DE VARIABLES';
      break;
    case '/opensoft/integral/logistic/planning':
      return 'SISTEMAS >> SG-LOGISTICA >> CONFIGURACION DOCUMENTO';
      break;
    case '/opensoft/integral/logistic/programs':
      return 'SISTEMAS >> SG-LOGISTICA >> PROGRAMAS';
      break;
    case '/opensoft/integral/logistic/documents':
      return 'SISTEMAS >> SG-LOGISTICA >> DOCUMENTOS';
      break;
    case '/opensoft/integral/logistic/formats':
      return 'SISTEMAS >> SG-LOGISTICA >> FORMATOS';
      break;

    // SISTEMAS >> SG-COMERCIAL
    case '/opensoft/integral/commercial/hankbook':
      return 'SISTEMAS >> SG-COMERCIAL >> CREACION DE DOCUMENTOS';
      break;
    case '/opensoft/integral/commercial/procedures':
      return 'SISTEMAS >> SG-COMERCIAL >> CREACION DE VARIABLES';
      break;
    case '/opensoft/integral/commercial/planning':
      return 'SISTEMAS >> SG-COMERCIAL >> CONFIGURACION DOCUMENTO';
      break;
    case '/opensoft/integral/commercial/programs':
      return 'SISTEMAS >> SG-COMERCIAL >> PROGRAMAS';
      break;
    case '/opensoft/integral/commercial/documents':
      return 'SISTEMAS >> SG-COMERCIAL >> DOCUMENTOS';
      break;
    case '/opensoft/integral/commercial/formats':
      return 'SISTEMAS >> SG-COMERCIAL >> FORMATOS';
      break;

    // SISTEMAS >> SG-OPERATIVA
    case '/opensoft/integral/operative/hankbook':
      return 'SISTEMAS >> SG-OPERATIVA >> CREACION DE DOCUMENTOS';
      break;
    case '/opensoft/integral/operative/procedures':
      return 'SISTEMAS >> SG-OPERATIVA >> CREACION DE VARIABLES';
      break;
    case '/opensoft/integral/operative/planning':
      return 'SISTEMAS >> SG-OPERATIVA >> CONFIGURACION DOCUMENTO';
      break;
    case '/opensoft/integral/operative/programs':
      return 'SISTEMAS >> SG-OPERATIVA >> PROGRAMAS';
      break;
    case '/opensoft/integral/operative/documents':
      return 'SISTEMAS >> SG-OPERATIVA >> DOCUMENTOS';
      break;
    case '/opensoft/integral/operative/formats':
      return 'SISTEMAS >> SG-OPERATIVA >> FORMATOS';
      break;

    // SISTEMAS >> SG-MEJORA CONTINUA
    case '/opensoft/integral/improvement/hankbook':
      return 'SISTEMAS >> SG-MEJORA CONTINUA >> CREACION DE DOCUMENTOS';
      break;
    case '/opensoft/integral/improvement/procedures':
      return 'SISTEMAS >> SG-MEJORA CONTINUA >> CREACION DE VARIABLES';
      break;
    case '/opensoft/integral/improvement/planning':
      return 'SISTEMAS >> SG-MEJORA CONTINUA >> CONFIGURACION DOCUMENTO';
      break;
    case '/opensoft/integral/improvement/programs':
      return 'SISTEMAS >> SG-MEJORA CONTINUA >> PROGRAMAS';
      break;
    case '/opensoft/integral/improvement/documents':
      return 'SISTEMAS >> SG-MEJORA CONTINUA >> DOCUMENTOS';
      break;
    case '/opensoft/integral/improvement/formats':
      return 'SISTEMAS >> SG-MEJORA CONTINUA >> FORMATOS';
      break;

    // SISTEMAS >> SG-DOCUMENTAL
    case '/opensoft/integral/documentary/hankbook':
      return 'SISTEMAS >> SG-DOCUMENTAL >> CREACION DE DOCUMENTOS';
      break;
    case '/opensoft/integral/documentary/procedures':
      return 'SISTEMAS >> SG-DOCUMENTAL >> CREACION DE VARIABLES';
      break;
    case '/opensoft/integral/documentary/planning':
      return 'SISTEMAS >> SG-DOCUMENTAL >> CONFIGURACION DOCUMENTO';
      break;
    case '/opensoft/integral/documentary/programs':
      return 'SISTEMAS >> SG-DOCUMENTAL >> PROGRAMAS';
      break;
    case '/opensoft/integral/documentary/documents':
      return 'SISTEMAS >> SG-DOCUMENTAL >> DOCUMENTOS';
      break;
    case '/opensoft/integral/documentary/formats':
      return 'SISTEMAS >> SG-DOCUMENTAL >> FORMATOS';
      break;

    /*================================================
        LOGISTICA
    ================================================*/

    // LOGISTICA >> COLABORADORES
    case '/opensoft/logistic/collaborators/position':
      return 'LOGISTICA >> COLABORADORES >> CREACION DE CARGOS';
      break;
    case '/opensoft/logistic/collaborators/hankbook':
      return 'LOGISTICA >> COLABORADORES >> MANUAL DE FUNCIONES';
      break;
    case '/opensoft/logistic/collaborators/bill':
      return 'LOGISTICA >> COLABORADORES >> MINUTA DE CONTRATO';
      break;
    case '/opensoft/logistic/collaborators/legalization':
      return 'LOGISTICA >> COLABORADORES >> LEGALIZACION DE CONTRATO';
      break;
    case '/opensoft/logistic/collaborators/affiliations':
      return 'LOGISTICA >> COLABORADORES >> AFILIACIONES SEGURIDAD SOCIAL';
      break;
    case '/opensoft/logistic/collaborators/endowments':
      return 'LOGISTICA >> COLABORADORES >> ENTREGA DE DOTACIONES';
      break;
    case '/opensoft/logistic/collaborators/tools':
      return 'LOGISTICA >> COLABORADORES >> ENTREGA DE EQUIPOS Y HERRAMIENTAS';
      break;
    case '/opensoft/logistic/collaborators/notifications':
      return 'LOGISTICA >> COLABORADORES >> NOTIFICACIONES';
      break;
    case '/opensoft/logistic/collaborators/control':
      return 'LOGISTICA >> COLABORADORES >> CONTROL DE AUSENCIA Y AUSENTISMO';
      break;
    case '/opensoft/logistic/collaborators/trainings':
      return 'LOGISTICA >> COLABORADORES >> CONTROL DE ASISTENCIA A CAPACITACIONES';
      break;
    case '/opensoft/logistic/collaborators/entranceexams':
      return 'LOGISTICA >> COLABORADORES >> EXAMENES MEDICOS DE INGRESO';
      break;
    case '/opensoft/logistic/collaborators/examsperiods':
      return 'LOGISTICA >> COLABORADORES >> EXAMENES MEDICOS PERIODICOS';
      break;
    case '/opensoft/logistic/collaborators/exitexams':
      return 'LOGISTICA >> COLABORADORES >> EXAMENES MEDICOS DE EGRESO';
      break;
    case '/opensoft/logistic/collaborators/tests':
      return 'LOGISTICA >> COLABORADORES >> EVALUACIONES DE DESEMPEÑO';
      break;

    // LOGISTICA >> CONTRATISTAS
    case '/opensoft/logistic/contractors/handbook':
      return 'LOGISTICA >> CONTRATISTAS >> MANUAL DE FUNCIONES';
      break;
    case '/opensoft/logistic/contractors/bill':
      return 'LOGISTICA >> CONTRATISTAS >> MINUTA DE CONTRATO';
      break;
    case '/opensoft/logistic/contractors/legalization':
      return 'LOGISTICA >> CONTRATISTAS >> LEGALIZACION DE CONTRATO';
      break;
    case '/opensoft/logistic/contractors/agreement':
      return 'LOGISTICA >> CONTRATISTAS >> CONVENIO DE COLABORACION EMPRESARIAL';
      break;
    case '/opensoft/logistic/contractors/tracking':
      return 'LOGISTICA >> CONTRATISTAS >> SEGUIMIENTO SEGURIDAD SOCIAL';
      break;
    case '/opensoft/logistic/contractors/notifications':
      return 'LOGISTICA >> CONTRATISTAS >> NOTIFICACIONES';
      break;
    case '/opensoft/logistic/contractors/control':
      return 'LOGISTICA >> CONTRATISTAS >> CONTROL DE AUSENCIA Y AUSENTISMO';
      break;
    case '/opensoft/logistic/contractors/trainings':
      return 'LOGISTICA >> CONTRATISTAS >> CONTROL DE ASISTENCIA A CAPACITACIONES';
      break;
    case '/opensoft/logistic/contractors/tests':
      return 'LOGISTICA >> CONTRATISTAS >> EVALUACIONES DE DESEMPEÑO';
      break;
    case '/opensoft/logistic/contractors/activations':
      return 'LOGISTICA >> CONTRATISTAS >> ACTIVACIONES DEL SISTEMA';
      break;

    // LOGISTICA >> PROVEEDORES
    case '/opensoft/logistic/providers/bill':
      return 'LOGISTICA >> PROVEEDORES >> MINUTA DE CONTRATO';
      break;
    case '/opensoft/logistic/providers/legalization':
      return 'LOGISTICA >> PROVEEDORES >> LEGALIZACION DE CONTRATO';
      break;
    case '/opensoft/logistic/providers/notifications':
      return 'LOGISTICA >> PROVEEDORES >> NOTIFICACIONES';
      break;
    case '/opensoft/logistic/providers/tests':
      return 'LOGISTICA >> PROVEEDORES >> EVALUACIONES DE DESEMPEÑO';
      break;
    case '/opensoft/logistic/providers/order':
      return 'LOGISTICA >> PROVEEDORES >> ORDEN DE COMPRA';
      break;

    // LOGISTICA >> PROGRAMAS
    case '/opensoft/logistic/programs/replacement':
      return 'LOGISTICA >> PROGRAMAS >> REPOSICION DEL PARQUE AUTOMOTOR';
      break;
    case '/opensoft/logistic/programs/control':
      return 'LOGISTICA >> PROGRAMAS >> CONTROL DE INFRACCIONES A LAS NORMAS DE TRANSITO';
      break;
    case '/opensoft/logistic/programs/report':
      return 'LOGISTICA >> PROGRAMAS >> INFORME DE CONTROL Y ANALISIS DE ACCIDENTES';
      break;
    case '/opensoft/logistic/programs/procedures':
      return 'LOGISTICA >> PROGRAMAS >> PROCEDIMIENTOS DE ATENCION AL USUARIO';
      break;
    case '/opensoft/logistic/programs/comunications':
      return 'LOGISTICA >> PROGRAMAS >> SISTEMA DE COMUNICACION BIDIRECCIONAL';
      break;
    case '/opensoft/logistic/programs/maintenance':
      return 'LOGISTICA >> PROGRAMAS >> REVISION DE MANTENIMIENTO PREVENTIVO';
      break;

    default:
      return 'GESTION DE MODIFICACIONES...';
      break;
  }
}


function loadDatatables() {
  $('#tableDatatable').css('font-size', '15px');
  $('#tableDatatable').DataTable({
    language: {
      processing: "Procesamiento en curso...",
      search: "Buscar:",
      lengthMenu: "Mostrar _MENU_ registros",
      info: "Mostrando _START_ a _END_ de _TOTAL_ registros. ",
      infoEmpty: "Mostrando dato 0 a 0 de 0 registros",
      emptyTable: "No hay registros disponibles",
      infoFiltered: "Filtrado de _MAX_ elementos totales",
      infoPostFix: "",
      loadingRecords: "Cargando...",
      zeroRecords: "No hay registros para mostrar",
      infoFiltered: "Filtrado de _MAX_ registros",
      paginate: {
        first: "|<",
        previous: "<",
        next: ">",
        last: ">|"
      }
    },
  });
}