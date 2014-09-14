<?php require_once('conectar/connection.php'); 

mysql_select_db($database_localhost, $localhost);
$query_tab_clientes = "select * from clientes";
$tab_clientes = mysql_query($query_tab_clientes,$localhost) or die(mysql_error());
$row_tab_clientes = mysql_fetch_assoc($tab_clientes);
$totalRows_tab_clientes = mysql_num_rows($tab_clientes);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Datatable</title>
<link href="styles/css.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="YUI/2.6.0/build/fonts/fonts-min.css" />
<link rel="stylesheet" type="text/css" href="YUI/2.6.0/build/paginator/assets/skins/sam/paginator.css" />
<link rel="stylesheet" type="text/css" href="YUI/2.6.0/build/datatable/assets/skins/sam/datatable.css" />
<script type="text/javascript" src="YUI/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="YUI/2.6.0/build/connection/connection-min.js"></script>
<script type="text/javascript" src="YUI/2.6.0/build/json/json-min.js"></script>
<script type="text/javascript" src="YUI/2.6.0/build/element/element-beta-min.js"></script>
<script type="text/javascript" src="YUI/2.6.0/build/paginator/paginator-min.js"></script>
<script type="text/javascript" src="YUI/2.6.0/build/datasource/datasource-min.js"></script>
<script type="text/javascript" src="YUI/2.6.0/build/datatable/datatable-min.js"></script>
<style type="text/css">
#paginated {
	text-align: center;
}
#paginated table {
	margin-left:auto; margin-right:auto;
}
#paginated, #paginated .yui-dt-loading {
	text-align: center; background-color: transparent;
}
.yui-dt table
{
    width: 85%;
}
</style>
<script language="JavaScript" type="text/JavaScript">
function maskIt(w,e,m,r,a){
        
        // Cancela se o evento for Backspace
        if (!e) var e = window.event
        if (e.keyCode) code = e.keyCode;
        else if (e.which) code = e.which;
        
        // Variáveis da função
        var txt  = (!r) ? w.value.replace(/[^\d]+/gi,'') : w.value.replace(/[^\d]+/gi,'').reverse();
        var mask = (!r) ? m : m.reverse();
        var pre  = (a ) ? a.pre : "";
        var pos  = (a ) ? a.pos : "";
        var ret  = "";

        if(code == 9 || code == 8 || txt.length == mask.replace(/[^#]+/g,'').length) return false;

        // Loop na máscara para aplicar os caracteres
        for(var x=0,y=0, z=mask.length;x<z && y<txt.length;){
                if(mask.charAt(x)!='#'){
                        ret += mask.charAt(x); x++;
                } else{
                        ret += txt.charAt(y); y++; x++;
                }
        }
        
        // Retorno da função
        ret = (!r) ? ret : ret.reverse()     
		// w.value = pre+ret+pos;   
        w.value = ret;
}

String.prototype.reverse = function(){
        return this.split('').reverse().join('');
};
</script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="yui-skin-sam">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabelastyle">
  
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td nowrap="nowrap">
              <table width="0" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td  align="center" style="color:#FFF">Acompanhamento de Confirma&ccedil;&otilde;es</td>
                </tr>
              </table>
            </td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" valign="top">    
      <?php if  ($totalRows_tab_clientes > 0) { ?>
     <div id='filtros' style='display:none; position:absolute;background-color:#D4E3F5;border-color:#BDD3EF;border-radius:5px;box-shadow: 0 1px 3px 1px rgba(0, 0, 0, 0.5);valign:baseline;padding: 15px 5px 10px 5px; top:1px;left: 1px;'>
     <label for='filter'><span>Cliente:</span></label> <input type='text' id='filter' value='' size="50">
     <label for='filter2'><span>A Vencer:</span></label> 
     <input type='text' id='filter2' value='' onKeyUp="maskIt(this,event,'###.###.###.###,##',true,{pre:'R$'})">
     <label for='filter3'><span>Falta Confirmar:</span></label> <input type='text' id='filter3' value='' onKeyUp="maskIt(this,event,'###.###.###.###,##',true,{pre:'R$'})"></div>
    <br />
    <br />
      <div id="paginated">      
      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabelastyle" id="yuidatatable1_data">
      <thead>
        <tr background="imagens/fund.png">
          <th height="23">Cliente</th>
          <th>A Vencer</th>
          <th>Adiantamento</th>
          <th>Atrasado</th>
          <th>Total de Compra</th>
          <th>Comprado M&ecirc;s Anterior</th>
          <th>Comprado M&ecirc;s Atual</th>
          <th><img src="imagens/search.png" width="12" height="12" /></th>
        </tr>
        </thead>
         <tbody>
        <?php do { ?>
          <tr class="grid">
            <td height="10" align="left" nowrap="nowrap"><a href="#" class="link"><?php echo $row_tab_clientes['NOME']; ?></a></td>
            <td align="center" nowrap="nowrap"><?php echo number_format($row_tab_clientes['TOTALAVENCER'],2,',','.'); ?></td>
            <td align="center" nowrap="nowrap"><?php echo number_format($row_tab_clientes['TOTALADIANTAMENTO'],2,',','.'); ?></td>
            <td align="center" nowrap="nowrap"><?php echo number_format($row_tab_clientes['TOTALATRASO'],2,',','.'); ?></td>
            <td align="center" nowrap="nowrap"><?php echo number_format($row_tab_clientes['TOTALCOMPRA'],2,',','.'); ?></td>
            <td align="center" nowrap="nowrap"><?php echo number_format($row_tab_clientes['SALDOANTERIOR'],2,',','.'); ?></td>
            <td align="center" nowrap="nowrap"><?php echo number_format($row_tab_clientes['SALDOATUAL'],2,',','.'); ?></td>
            <td></td>
          </tr>
          <?php
		   } while ($row_tab_clientes = mysql_fetch_assoc($tab_clientes)); ?>
          </tbody>
      </table>
      </div>
      <script type="text/javascript">
			
YAHOO.util.Event.addListener(window, "load", function() {
			var sortStatesCliente = function(a, b, desc) { 
	            if(!YAHOO.lang.isValue(a)) { 
	                return (!YAHOO.lang.isValue(b)) ? 0 : 1; 
	            } 
	            else if(!YAHOO.lang.isValue(b)) { 
	                return -1; 
	            } 
	            // First compare by state 
	            var comp = YAHOO.util.Sort.compare; 
				var valor1=a.getData("Cliente");
				var valor2=b.getData("Cliente");
				//alert(valor1);
				var valortotal = valor1.split("class=\"link\">")[1];
				var valortotal = valortotal.split("</a>")[0];
				//alert(valortotal);
				var valortotal2 = valor2.split("class=\"link\">")[1];
				var valortotal2 = valortotal2.split("</a>")[0];
			
				var compState = comp(valor1, valor2, desc); 
	            return (compState !== 0) ? compState : comp(a.getData("avencer"), b.getData("avencer"), desc); 
	        };
			
			var sortStatesValue = function(a, b, desc) { 
	            if(!YAHOO.lang.isValue(a)) { 
	                return (!YAHOO.lang.isValue(b)) ? 0 : 1; 
	            } 
	            else if(!YAHOO.lang.isValue(b)) { 
	                return -1; 
	            } 
	            // First compare by state 
	            var comp = YAHOO.util.Sort.compare; 
				var valor1=a.getData("avencer");
				var valor2=b.getData("avencer");
				var valortotal = parseInt(valor1.replace(/\D/g,""));
				var valortotal2 = parseInt(valor2.replace(/\D/g,""));
			
				var compState = comp(valortotal, valortotal2, desc); 
	            return (compState !== 0) ? compState : comp(a.getData("Cliente"), b.getData("Cliente"), desc); 
	        };
			var sortStatesValueCompraDoMesAtual = function(a, b, desc) { 
	            if(!YAHOO.lang.isValue(a)) { 
	                return (!YAHOO.lang.isValue(b)) ? 0 : 1; 
	            } 
	            else if(!YAHOO.lang.isValue(b)) { 
	                return -1; 
	            } 
	            // First compare by state 
	            var comp = YAHOO.util.Sort.compare; 
				var valor1=a.getData("compradomesatual");
				var valor2=b.getData("compradomesatual");
				var valortotal = parseInt(valor1.replace(/\D/g,""));
				var valortotal2 = parseInt(valor2.replace(/\D/g,""));
			
				var compState = comp(valortotal, valortotal2, desc); 
	            return (compState !== 0) ? compState : comp(a.getData("Cliente"), b.getData("Cliente"), desc); 
	        };
			
			var sortStatesValueAdiantamento = function(a, b, desc) { 
	            if(!YAHOO.lang.isValue(a)) { 
	                return (!YAHOO.lang.isValue(b)) ? 0 : 1; 
	            } 
	            else if(!YAHOO.lang.isValue(b)) { 
	                return -1; 
	            } 
	            // First compare by state 
	            var comp = YAHOO.util.Sort.compare; 
				var valor1=a.getData("adiantamento");
				var valor2=b.getData("adiantamento");
				var valortotal = parseInt(valor1.replace(/\D/g,""));
				var valortotal2 = parseInt(valor2.replace(/\D/g,""));
			
				var compState = comp(valortotal, valortotal2, desc); 
	            return (compState !== 0) ? compState : comp(a.getData("Cliente"), b.getData("Cliente"), desc); 
	        };
			var sortStatesValueAtrasado = function(a, b, desc) { 
	            if(!YAHOO.lang.isValue(a)) { 
	                return (!YAHOO.lang.isValue(b)) ? 0 : 1; 
	            } 
	            else if(!YAHOO.lang.isValue(b)) { 
	                return -1; 
	            } 
	            // First compare by state 
	            var comp = YAHOO.util.Sort.compare; 
				var valor1=a.getData("atrasado");
				var valor2=b.getData("atrasado");
				var valortotal = parseInt(valor1.replace(/\D/g,""));
				var valortotal2 = parseInt(valor2.replace(/\D/g,""));
			
				var compState = comp(valortotal, valortotal2, desc); 
	            return (compState !== 0) ? compState : comp(a.getData("Cliente"), b.getData("Cliente"), desc); 
	        };
			var sortStatesValueTotalDeCompra = function(a, b, desc) { 
	            if(!YAHOO.lang.isValue(a)) { 
	                return (!YAHOO.lang.isValue(b)) ? 0 : 1; 
	            } 
	            else if(!YAHOO.lang.isValue(b)) { 
	                return -1; 
	            } 
	            // First compare by state 
	            var comp = YAHOO.util.Sort.compare; 
				var valor1=a.getData("totaldecompra");
				var valor2=b.getData("totaldecompra");
				var valortotal = parseInt(valor1.replace(/\D/g,""));
				var valortotal2 = parseInt(valor2.replace(/\D/g,""));
			
				var compState = comp(valortotal, valortotal2, desc); 
	            return (compState !== 0) ? compState : comp(a.getData("Cliente"), b.getData("Cliente"), desc); 
	        };
			var sortStatesValueCompraDoMesAnterior = function(a, b, desc) { 
	            if(!YAHOO.lang.isValue(a)) { 
	                return (!YAHOO.lang.isValue(b)) ? 0 : 1; 
	            } 
	            else if(!YAHOO.lang.isValue(b)) { 
	                return -1; 
	            } 
	            // First compare by state 
	            var comp = YAHOO.util.Sort.compare; 
				var valor1=a.getData("compradomesanterior");
				var valor2=b.getData("compradomesanterior");
				var valortotal = parseInt(valor1.replace(/\D/g,""));
				var valortotal2 = parseInt(valor2.replace(/\D/g,""));
			
				var compState = comp(valortotal, valortotal2, desc); 
	            return (compState !== 0) ? compState : comp(a.getData("Cliente"), b.getData("Cliente"), desc); 
	        };
			
	var cols = [
        	{key:"Cliente", label:"Cliente", sortable:true, allowHTML: true, sortOptions:{sortFunction:sortStatesCliente}},
            {key:"avencer", label:"A Vencer", sortable: true, sortOptions:{sortFunction:sortStatesValue}},
            {key:"adiantamento", label:"Adiantamento", sortable:true, allowHTML: true, sortOptions:{sortFunction:sortStatesValueAdiantamento}},
            {key:"atrasado", label:"Atrasado", sortable:true, allowHTML: true, sortOptions:{sortFunction:sortStatesValueAtrasado}},
            {key:"totaldecompra", label:"Total de Compra", sortable:true, allowHTML: true, sortOptions:{sortFunction:sortStatesValueTotalDeCompra}},
			{key:"compradomesanterior", label:"Comprado Mês Anterior", sortable:true, allowHTML: true, sortOptions:{sortFunction:sortStatesValueCompraDoMesAnterior}},
			{key:"compradomesatual", label:"Comprado Mês Atual", sortable:true, allowHTML: true, sortOptions:{sortFunction:sortStatesValueCompraDoMesAtual}},
			{key:"+",label:"<img src='imagens/search.png' title='Filtro rápido' id='imagemf' width='16' height='16' />", allowHTML: true}
    ];
	
	   var conf = {
                paginator: new YAHOO.widget.Paginator({
                    rowsPerPage: 15,
					template: '{FirstPageLink} {PreviousPageLink} {PageLinks} {NextPageLink} {LastPageLink} {RowsPerPageDropdown}<br>{CurrentPageReport}',
			 		rowsPerPageOptions: [15,25,50,100,200,500],
					pageLinks     : 3,
					pageReportTemplate : "{startRecord} &agrave; {endRecord} de {totalRecords}"
                })
        };

	YAHOO.example.ClientPagination = function() {

   var dataSource = new YAHOO.util.DataSource(YAHOO.util.Dom.get("yuidatatable1_data"),{
        responseType : YAHOO.util.DataSource.TYPE_HTMLTABLE,
        responseSchema : {
            fields : [
        	{key:"Cliente"},
            {key:"avencer"},
            {key:"adiantamento"},
            {key:"atrasado"},
            {key:"totaldecompra"},
			{key:"compradomesanterior"},
			{key:"compradomesatual"},
			{key:"+"}
			],
			metaFields: {
				resultsList: "records",
                totalRecords: "totalRecords",
                paginationRecordOffset : "startIndex",
                sortKey: "sort",
                sortDir: "dir"
            }
        },
        doBeforeCallback : function (req,raw,res,cb) {
            var data     = res.results || [],
                filtered = [],
                i,l;
				
				if(document.getElementById('filter')){
					var filtro1 = document.getElementById('filter').value;
					var filtro2 = document.getElementById('filter2').value;
					var filtro3 = document.getElementById('filter3').value;
				}else{
					var filtro1 = '';
					var filtro2 = '';
					var filtro3 = '';
				}

            if ((req)||(filtro1 != '')||(filtro2 != '')||(filtro3 != '')) {
				filtro1 = filtro1.toLowerCase();				
				filtro2 = filtro2.toLowerCase();
				filtro3 = filtro3.toLowerCase();
                req = req.toLowerCase();
                for (i = 0, l = data.length; i < l; ++i) {
					if(filtro1 != ''){
						 var valortotal = data[i].Cliente.split("class=\"link\">")[1];
				          valortotal = valortotal.split("</a>")[0];
					  if (!valortotal.toLowerCase().indexOf(filtro1)) {
						  if (filtro2 != ''){
							if (!data[i].avencer.toLowerCase().indexOf(filtro2)) {
								if(filtro3 != ''){
									if (!data[i].totaldecompra.toLowerCase().indexOf(filtro3)) {
										filtered.push(data[i]);
									}
								}else{
									filtered.push(data[i]);
								}
							}
						  }else if(filtro3 != ''){
							  if (!data[i].totaldecompra.toLowerCase().indexOf(filtro3)) {
										filtered.push(data[i]);
								}						  
						  }else{
						  		filtered.push(data[i]);
						  }
					  }
					  
					}else if (filtro2 != ''){
							if (!data[i].avencer.toLowerCase().indexOf(filtro2)) {
								if(filtro3 != ''){
									if (!data[i].totaldecompra.toLowerCase().indexOf(filtro3)) {
										filtered.push(data[i]);
									}
								}else{
									filtered.push(data[i]);
								}
							}
					}else if (filtro3 != ''){
						if (!data[i].totaldecompra.toLowerCase().indexOf(filtro3)) {
							filtered.push(data[i]);
						}
							  
					}
                }
                res.results = filtered;
            }

            return res;
        }
    });



   var dataTable = new YAHOO.widget.DataTable('paginated',cols,dataSource,conf);
   
   
   		dataTable.subscribe("headerCellClickEvent", function (e){
			
			 var teste = (this.getColumn(e.target).key);
			 
			 if(teste == '+'){
				if (document.getElementById('filtros').style.display == 'block'){
					document.getElementById('filtros').style.display = 'none';
					document.getElementById('imagemf').src ="imagens/search.png";
					document.getElementById('filter').value = '';
					document.getElementById('filter2').value = '';
					document.getElementById('filter3').value = '';
					clearTimeout(filterTimeout);
					setTimeout(updateFilter,600);
					
				}else{
					document.getElementById('filtros').style.display = 'block';
					document.getElementById('imagemf').src ="imagens/search1.png";				
				}
			 }
			});   

    var filterTimeout = null;
    var updateFilter  = function () {
        // Reset timeout
        var filterTimeout = null;
        
        // Reset sort
        var state = dataTable.getState();
            state.sortedBy = {key:'Cliente', dir:YAHOO.widget.DataTable.CLASS_ASC};

        // Get filtered data
        dataSource.sendRequest(YAHOO.util.Dom.get('filter').value,{
            success : dataTable.onDataReturnInitializeTable,
            failure : dataTable.onDataReturnInitializeTable,
            scope   : dataTable,
            argument: state
        });
		 
    };
	
	 var updateFilter2  = function () {
        // Reset timeout
        var filterTimeout = null;
        
        // Reset sort
        var state = dataTable.getState();
            state.sortedBy = {key:'Cliente', dir:YAHOO.widget.DataTable.CLASS_ASC};

        // Get filtered data
        dataSource.sendRequest(YAHOO.util.Dom.get('filter2').value,{
            success : dataTable.onDataReturnInitializeTable,
            failure : dataTable.onDataReturnInitializeTable,
            scope   : dataTable,
            argument: state
        });
		 
    };
	 var updateFilter3  = function () {
        // Reset timeout
        var filterTimeout = null;
        
        // Reset sort
        var state = dataTable.getState();
            state.sortedBy = {key:'Cliente', dir:YAHOO.widget.DataTable.CLASS_ASC};

        // Get filtered data
        dataSource.sendRequest(YAHOO.util.Dom.get('filter3').value,{
            success : dataTable.onDataReturnInitializeTable,
            failure : dataTable.onDataReturnInitializeTable,
            scope   : dataTable,
            argument: state
        });
		 
    };

    YAHOO.util.Event.on('filter','keyup',function (e) {
        clearTimeout(filterTimeout);
        setTimeout(updateFilter,600);
    });
	
	YAHOO.util.Event.on('filter2','keyup',function (e) {
        clearTimeout(filterTimeout);
        setTimeout(updateFilter2,600);
    });
	YAHOO.util.Event.on('filter3','keyup',function (e) {
        clearTimeout(filterTimeout);
        setTimeout(updateFilter3,600);
    });
	
	 return {
            oDS: dataSource,
            oDT: dataTable
        };
    }();
});
</script>
      <?php } else { ?>
      <strong>N&atilde;o foram encontratos registros.<?php } ?></strong></td>
  </tr>
</table>
</body>
</html>
<?php mysql_free_result($tab_clientes);?>