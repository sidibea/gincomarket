<?php /*%%SmartyHeaderCode:543728565901f40d2c7073-50652680%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ae7789ea4281cd5cf86628a70c3e2467e94a13ac' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/categorysearch/categorysearch-top.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
    'ea9a3b6ac90d7f9d1013ea2f8250aa29551eee9a' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/categorysearch/categorysearch-instantsearch.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '543728565901f40d2c7073-50652680',
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_590657916909d3_35878019',
  'has_nocache_code' => false,
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_590657916909d3_35878019')) {function content_590657916909d3_35878019($_smarty_tpl) {?><!-- block seach mobile -->
<!-- Block search module TOP -->

<div id="search_block_top" class="clearfix">
<form id="searchbox" method="get" action="http://gincomarket.com/pr/fr/module/categorysearch/catesearch" >
        <input type="hidden" name="fc" value="module" />
        <input type="hidden" name="module" value="categorysearch" />
		<input type="hidden" name="controller" value="catesearch" />
		<input type="hidden" name="orderby" value="position" />
		<input type="hidden" name="orderway" value="desc" />
        <select id="search_category" name="search_category" class="form-control">
            <option value="all">Toutes les catégories</option>
            <option value="2">Accueil</option><option value="3">--Femmes</option><option value="4">----Tops</option><option value="5">------T-shirts</option><option value="7">------Chemisiers</option><option value="8">----Robes</option><option value="9">------Robes décontractées</option><option value="10">------Robes de soirée</option><option value="11">------Robes d'été</option><option value="13">--Produits</option><option value="14">----Vêtement</option><option value="15">------Homme</option><option value="28">--------Chemises</option><option value="38">--------maillots de bain</option><option value="24">--------T-short et polos</option><option value="39">--------Jeans</option><option value="25">--------Pantalons</option><option value="26">--------Chauchette</option><option value="27">--------Vestes et manteaux</option><option value="40">--------Sous-vetement</option><option value="41">--------Accessoire</option><option value="29">--------Autres</option><option value="16">------Femme</option><option value="30">--------Blouses</option><option value="31">--------Robes</option><option value="32">--------jupes</option><option value="33">--------Pantalons</option><option value="34">--------Costumes</option><option value="35">--------Autres</option><option value="42">--------Jeans</option><option value="43">--------Lingeries</option><option value="44">--------Maillots de bain</option><option value="45">--------Pulls et gilets</option><option value="17">------Garcons</option><option value="51">--------Pantalons</option><option value="52">--------T-shirt et polos</option><option value="53">--------Chemises</option><option value="54">--------Culottes</option><option value="55">--------Autres</option><option value="36">------Filles</option><option value="46">--------jupes</option><option value="47">--------Pantalons</option><option value="48">--------Robes</option><option value="49">--------T-short et tops</option><option value="50">--------Autres</option><option value="37">------Bebes</option><option value="56">--------Bebe Fille 0-24 mois</option><option value="59">----------Robes</option><option value="60">----------Pyjamas</option><option value="61">----------Bodys</option><option value="62">----------Hauts</option><option value="63">----------Autres</option><option value="57">--------Bebe Garcons 0-24 mois</option><option value="64">----------Ensembles</option><option value="65">----------Pyjamas</option><option value="66">----------Bodys</option><option value="67">----------Hauts</option><option value="68">----------Autres</option><option value="18">------Chaussur</option><option value="19">------Sous-vetement</option><option value="21">------Lingerie</option><option value="22">------Autres</option><option value="23">------Accessoire</option><option value="69">----Beautes, Santes et Hygienes</option><option value="70">------Cosmetiques</option><option value="71">------Maquillages</option><option value="72">------Santes</option><option value="95">------Parfums</option><option value="73">------Autres</option><option value="74">----Eletroniques</option><option value="75">------Televisions</option><option value="76">------Cameras et Aprail photos</option><option value="77">------Telephone et Accessoires</option><option value="78">------Ordinateurs</option><option value="80">--------Ordinateurs de Bureau</option><option value="81">--------Ordinateurs portables</option><option value="82">--------Autres</option><option value="79">------Tablettes</option><option value="83">------Autres</option><option value="84">----Maisons et Bureaux</option><option value="86">------Fournitures</option><option value="89">--------Bureaux</option><option value="90">--------Maisons</option><option value="87">------Eletromenagers</option><option value="88">------Eletroniques</option><option value="91">------Electricites</option><option value="92">------Plomberies</option><option value="93">----Sports</option><option value="98">------Football</option><option value="99">------Taekwondo</option><option value="100">------Basket</option><option value="101">------Gyms</option><option value="102">------Autres Sports</option><option value="96">----Accessoire</option><option value="97">------Bijoux</option><option value="103">----Alimentations</option><option value="104">------Fruits et Legumes</option><option value="105">------Produits laitiers</option><option value="106">------Chocolats</option><option value="107">------Viandes</option><option value="108">------Fruits de Mers</option><option value="109">------Poissons</option><option value="110">------Conserves</option><option value="111">------Biscuits</option><option value="112">------Boissons</option><option value="113">--------Alcoolisers</option><option value="114">--------Non Alcoolisers</option><option value="115">------Autres</option><option value="116">--Services</option><option value="117">----Hotels et Resteaurants</option><option value="118">----Transports</option><option value="119">----Pressing</option><option value="120">----Gyms</option><option value="121">----Autres</option><option value="123">----Couturiers et Salons de Coifures</option><option value="122">--Evenements</option>
        </select>
		<input class="search_query form-control" type="text" id="search_query_top" name="search_query" placeholder="Entrez votre mot-clé ..." value="" />
		<button type="submit" name="submit_search" class="btn btn-default button-search">
			<span>Rechercher</span>
		</button>
	</form>
</div>
	<script type="text/javascript">
    var moduleDir = "/pr/modules/categorysearch/";
	var searchUrl = baseDir + 'modules/categorysearch/finds.php?rand=' + new Date().getTime();
    var maxResults = 15;
    //var search_category = $('#search_category option:selected').val()
	// <![CDATA[
		$('document').ready( function() {
            var select = $( "#search_category" ),
            options = select.find( "option" ),
            selectType = options.filter( ":selected" ).attr( "value" );
            
            $("#search_query_top").autocomplete(
                searchUrl, {
        			minChars: 3,
        			max: maxResults,
        			width: 500,
        			selectFirst: false,
        			scroll: false,
                    cacheLength: 0,
        			dataType: "json",
        			formatItem: function(data, i, max, value, term) {
        				return value;
        			},
        			parse: function(data) {
							var mytab = new Array();
							for (var i = 0; i < data.length; i++)
								mytab[mytab.length] = { data: data[i], value: '<img src="' + data[i].product_image + '" alt="' + data[i].pname + '" height="30" /> &nbsp;&nbsp;' + data[i].cname + ' > ' + data[i].pname, icon: data[i].product_image};
							return mytab;
						},
        			extraParams: {
        				ajax_Search: 1,
        				id_lang: 1,
                        id_category: selectType
        			}
                }
            )
            .result(function(event, data, formatted) {
				$('#search_query_top').val(data.pname);
				document.location.href = data.product_link;
			});
        
            select.change(function () {
                selectType = options.filter( ":selected" ).attr( "value" );
                $( ".ac_results" ).remove();
                $("#search_query_top").autocomplete(
                    searchUrl, {						
            			minChars: 3,
            			max: maxResults,
            			width: 500,
            			selectFirst: false,
            			scroll: false,
                        cacheLength: 0,
            			dataType: "json",
            			formatItem: function(data, i, max, value, term) {
            				return value;
            			},
            			parse: function(data) {
            			     
							var mytab = new Array();
							for (var i = 0; i < data.length; i++)
								mytab[mytab.length] = { data: data[i], value: data[i].cname + ' > ' + data[i].pname };
                                mytab[mytab.length] = { data: data[i], value: '<img src="' + data[i].product_image + '" alt="' + data[i].pname + '" height="30" />' + '<span class="ac_product_name">' + pname + '</span>' };
							return mytab;
						},
            			extraParams: {
            				ajax_Search: 1,
            				id_lang: 1,
                            id_category: selectType
            			}
                    }
                );
            });
		});
	// ]]>
	</script>


<!-- /Block search module TOP -->
<?php }} ?>
