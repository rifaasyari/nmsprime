<?php

return [
    // Index DataTable Header
    'amount' => 'Cantidad',
    'city' => 'Ciudad',
    'connected' => 'Conectado',
    'connection_type' => 'Tipo de conexión',
    'deprecated' => 'Deprecated',
    'district' => 'Distrito',
    'email' => 'Email',
    'expansion_degree' => 'Grado de expansión',
    'floor' => 'Piso',
    'group_contract' => 'Contrato de grupo',
    'house_nr' => 'Numero de vivienda',
    'iban' => 'Cuenta bancaria (código IBAN)',
    'id'            => 'ID',
    'name' => 'Nombre',
    'number' => 'Número',
    'occupied' => 'Ocupado',
    'prio'          => 'Prioridad',
    'street' => 'Calle',
    'sum' => 'Suma',
    'type' => 'Tipo',
    'zip' => 'Código postal',
    'apartment' => [
        'number' => 'Número',
        'connected' => 'Conectado',
        'occupied' => 'Ocupado',
    ],
    'contact' => [
        'administration' => 'Administración',
    ],
    // Auth
    'users' => [
        'login_name' => 'Login Name',
        'first_name' => 'Given Name',
        'last_name' => 'Family Name',
        'geopos_updated_at' => 'Last geopos update',
    ],
    'roles.title' => 'Función',
    'roles.rank' => 'Nivel',
    'roles.description' => 'Descripción 	',
    // GuiLog
    'guilog.created_at' => 'Hora',
    'guilog.username' => 'Usuario',
    'guilog.method' => 'Acción',
    'guilog.model' => 'Modelo',
    'guilog.model_id' => 'Modelo ID',
    // Company
    'company.name' => 'Nombre De La Empresa',
    'company.city' => 'Ciudad',
    'company.phone' => 'Número de teléfono celular',
    'company.mail' => 'Email',
    // Costcenter
    'costcenter.name' => 'Precio',
    'costcenter.number' => 'Importe',
    'debt' => [
        'date' => 'Fecha',
        'due_date' => 'Fecha límite',
        'indicator' => 'Indicador de Dunning',
        'missing_amount' => 'Cantidad faltante',
        'number' => 'número de deuda',
        'total_fee' => 'Tarifa',
        'voucher_nr' => 'Nr de voucher',
    ],
    //Invoices
    'invoice.type' => 'Tipo',
    'invoice.year' => 'Año',
    'invoice.month' => 'Mes',
    //Item
    'item.valid_from' => 'Artículo válido desde',
    'item.valid_from_fixed' => 'Artículo válido de fijo',
    'item.valid_to' => 'Artículo válido para',
    'item.valid_to_fixed' => 'Artículo válido a fijo',
    'fee' => 'Tarifa',
    'product' => [
        'proportional' => 'Proporcionado',
        'type' => 'Tipo',
        'name' => 'Nombre del producto',
        'price' => 'Precio',
    ],
    // Salesman
    'salesman.id' => 'ID',
    'salesman_id' 		=> 'ID del vendedor',
    'salesman_firstname' => 'Nombre',
    'salesman_lastname' => 'Apellido',
    'commission in %' 	=> 'Comisión en %',
    'contract_nr' 		=> 'Nro. de Contrato',
    'contract_name' 	=> 'Cliente',
    'contract_start' 	=> 'Inicio de Contrato',
    'contract_end' 		=> 'Fin de Contrato',
    'product_name' 		=> 'Producto',
    'product_type' 		=> 'Tipo de Producto',
    'product_count' 	=> 'Contar',
    'charge' 			=> 'Cambiar',
    'salesman.lastname' => 'Apellidos',
    'salesman.firstname' => 'Nombres',
    'salesman_commission' => 'Comisión',
    'sepaaccount_id' 	=> 'ID Cuenta SEPA',
    'sepaaccount' => [
        'iban' => 'Cuenta bancaria (código IBAN)',
        'institute' => 'Instituto',
        'name' => 'Nombre de la cuenta',
        'template_invoice' => 'Plantilla de factura',
    ],
    // SepaMandate
    'sepamandate.holder' => 'Titular de la cuenta',
    'sepamandate.valid_from' => 'Válido desde',
    'sepamandate.valid_to' => 'Válido hasta',
    'sepamandate.reference' => 'Referencia de cuenta',
    'sepamandate.disable' => 'Desactivado',
    // SettlementRun
    'settlementrun.year' => 'Año',
    'settlementrun.month' => 'Mes',
    'settlementrun.created_at' => 'Creado el',
    'settlementrun.executed_at' => 'Ejecutado en',
    'verified' => 'Verificado?',
    // MPR
    'mpr.name' => 'Nombre',
    'mpr.id'    => 'ID',
    // NetElement
    'netelement.id' => 'ID',
    'netelement.name' => 'Elemento de red',
    'netelement.ip' => 'Direccion IP',
    'netelement.state' => 'Estado',
    'netelement.pos' => 'Posición',
    'netelement.options' => 'Opciones',
    // NetElementType
    'netelementtype.name' => 'Tipo de elemento de red',
    //HfcSnmp
    'parameter.oid.name' => 'Nombre OID',
    //Mibfile
    'mibfile.id' => 'ID',
    'mibfile.name' => 'Archivo MIB',
    'mibfile.version' => 'Versión',
    // OID
    'oid.name_gui' => 'Etiqueta de GUI',
    'oid.name' => 'Nombre OID',
    'oid.oid' => 'OID',
    'oid.access' => 'Tipo de acceso',
    //SnmpValue
    'snmpvalue.oid_index' => 'Indice OID',
    'snmpvalue.value' => 'Valor OID',
    // MAIL
    'email.localpart' => 'Parte local',
    'email.index' => 'E-Mail primario?',
    'email.greylisting' => '¿Activo listas de rechazo transitorio?',
    'email.blacklisting' => 'Lista negra habilitada?',
    'email.forwardto' => 'Reenviar a:',
    'contact.firstname1' => 'Nombre 1',
    'lastname1' => 'Apellido 1',
    'firstname2' => 'Nombre 2',
    'lastname2' => 'Apellido 2',
    'tel' => 'Número de teléfono',
    'tel_private' => 'Número de teléfono privado',
    'email1' => 'E-Mail 1',
    'email2' => 'E-Mail 2',
    // NetGw
    'netgw.id' => 'ID',
    'netgw.hostname' => 'Hostname',
    'netgw.ip' => 'IP',
    'netgw.company' => 'Manufacturer',
    'netgw.series' => 'Series',
    'netgw.formatted_support_state' => 'Support State',
    'netgw.support_state' => 'Support State',
    // Contract
    'contact_id' => 'Group contract',
    'contract.city' => 'Ciudad',
    'company' => 'Compañía',
    'contract.contract_end' => 'Fin de Contrato',
    'contract.contract_start' => 'Inicio de Contrato',
    'district' => 'Distrito',
    'contract.firstname' => 'Nombres',
    'contract.house_number' => 'Numero de vivienda',
    'contract.id' => 'Contrato',
    'contract.lastname' => 'Apellidos',
    'contract.number' => 'Numero',
    'contract.street' => 'Calle',
    'contract.zip' => 'Código postal',
    // Domain
    'domain.name' => 'Nombre del dominio',
    'domain.type' => 'Tipo',
    'domain.alias' => 'Alias',
    // Endpoint
    'endpoint.ip' => 'IP',
    'endpoint.hostname' => 'Nombre de host',
    'endpoint.mac' => 'MAC',
    'endpoint.description' => 'Descripción 	',
    // IpPool
    'ippool.id' => 'ID',
    'ippool.type' => 'Tipo',
    'ippool.net' => 'Red',
    'ippool.netmask' => 'Máscara de red',
    'ippool.router_ip' => 'Ip de Router',
    'ippool.description' => 'Descripcion',
    // Modem
    'modem.city' => 'Ciudad',
    'modem.district' => 'Distrito',
    'modem.firstname' => 'Nombres',
    'modem.geocode_source' => 'Geolocalización',
    'modem.house_number' => 'Numero de vivienda',
    'modem.id' => 'Modem ID',
    'modem.inventar_num' => 'Serial',
    'modem.lastname' => 'Apellidos',
    'modem.mac' => 'Direccion MAC',
    'modem.model' => 'Modelo',
    'modem.name' => 'Nombre del modem',
    'modem.street' => 'Calle',
    'modem.sw_rev' => 'Version de Firmware',
    'modem.ppp_username' => 'PPP Username',
    'modem.us_pwr' => 'Nivel US',
    'modem.support_state' => 'Estado de Soporte',
    'modem.formatted_support_state' => 'Estado de Soporte',
    'contract_valid' => 'Contrato valido?',
    // Node
    'node' => [
        'name' => 'Nombre',
        'headend' => 'Cabecera',
        'type' => 'Tipo de señal',
    ],
    // QoS
    'qos.name' => 'Nombre de QoS',
    'qos.ds_rate_max' => 'Velocidad maxima de bajada',
    'qos.us_rate_max' => 'Velocidad maxima de subida',
    // Mta
    'mta.hostname' => 'Nombre de Host',
    'mta.mac' => 'Direccion MAC',
    'mta.type' => 'Protocolo VOIP',
    // Configfile
    'configfile.name' => 'Archivo de configuracion',
    // PhonebookEntry
    'phonebookentry.id' => 'ID',
    // Phonenumber
    'phonenumber.prefix_number' => 'Prefijo',
    'phonenr_act' => 'Fecha de activacion',
    'phonenr_deact' => 'Fecha de desactivacion',
    'phonenr_state' => 'Estado',
    'modem_city' => 'Ciudad del modem',
    'sipdomain' => 'Registrar',
    // Phonenumbermanagement
    'phonenumbermanagement.id' => 'ID',
    'phonenumbermanagement.activation_date' => 'Fecha de activacion',
    'phonenumbermanagement.deactivation_date' => 'Fecha de desactivacion',
    // PhoneTariff
    'phonetariff.name' => 'Tarifa telefonica',
    'phonetariff.type' => 'Tipo',
    'phonetariff.description' => 'Descripcion',
    'phonetariff.voip_protocol' => 'Protocolo VOIP',
    'phonetariff.usable' => 'Disponible?',
    // ENVIA enviaorder
    'enviaorder.ordertype'  => 'Tipo de orden',
    'enviaorder.orderstatus'  => 'Estado de orden',
    'escalation_level' => 'Nivel de estado',
    'enviaorder.created_at'  => 'Creado el',
    'enviaorder.updated_at'  => 'Subido el',
    'enviaorder.orderdate'  => 'Fecha de orden',
    'enviaorder_current'  => 'Acciones necesarias?',
    'enviaorder.contract.number' => 'Contrato',
    'phonenumber.number' => 'Numero',
    //ENVIA Contract
    'enviacontract.contract.number' => 'Contrato',
    'enviacontract.end_date' => 'Fecha de desenlace',
    'enviacontract.envia_contract_reference' => 'envia TEL referencia de contrato',
    'enviacontract.start_date' => 'Fecha de inicio',
    'enviacontract.state' => 'Estado',
    // CDR
    'cdr.calldate' => 'Fecha de llamada',
    'cdr.caller' => 'Emisor',
    'cdr.called' => 'Receptor',
    'cdr.mos_min_mult10' => 'MOS minimo',
    // Numberrange
    'numberrange.id' => 'ID',
    'numberrange.name' => 'Nombre',
    'numberrange.start' => 'Inicio',
    'numberrange.end' => 'Fin',
    'numberrange.prefix' => 'Prefijo',
    'numberrange.suffix' => 'Sufijo',
    'numberrange.type' => 'Tipo',
    'numberrange.costcenter.name' => 'Centro de costes',
    'realty' => [
        'agreement_from' => 'Válido desde',
        'agreement_to' => 'Válido hasta',
        'apartmentCount' => 'Total de apartamentos',
        'apartmentCountConnected' => 'Apartamentos conectados',
        'city' => 'Ciudad',
        'concession_agreement' => 'Acuerdo de concesión',
        'contact_id' => 'Administración',
        'contact_local_id' => 'Contacto local',
        'district' => 'Distrito',
        'house_nr' => 'Nº de casa',
        'last_restoration_on' => 'Última restauración',
        'name' => 'Nombre',
        'street' => 'Calle',
        'zip' => 'Código postal',
    ],
    // NAS
    'nas' => [
        'nasname' => 'Name',
    ],
    // Ticket
    'ticket.id' => 'ID',
    'ticket.name' => 'Titulo',
    'ticket.type' => 'Tipo',
    'ticket.priority' => 'Prioridad',
    'ticket.state' => 'Estado',
    'ticket.user_id' => 'Creado por',
    'ticket.created_at' => 'Creando el',
    'ticket.assigned_users' => 'Usuarios asignados',
    'assigned_users' => 'Usuarios asignados',
    'tickettypes.name' => 'Tipo',
];
