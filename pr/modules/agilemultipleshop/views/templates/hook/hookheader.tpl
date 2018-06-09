{*
*}
<script language="javascript" type="text/javascript">
var header_logo_mode = {$header_logo_mode};
var base_dir_default = "{$base_dir_default}";
var base_dir = "{$base_dir}";
var HOOK_SELLER_HEADER_LOGO = '{$HOOK_SELLER_HEADER_LOGO}';
var seller_logo_url = "{$seller_logo_url}";
var id_shop_owner = {$id_shop_owner};

$('document').ready(function() {
	var seller_header_logo_id = $("a#seller_header_logo").attr("id");
	/** _agile_ alert(seller_header_logo_id); _agile_ **/

	var tag = $("#header_logo");
	if(!tag || !tag.is("a"))tag = $("#header_logo a");

	/** _agile_ main store logo only _agile_ **/
	if(header_logo_mode ==0)
	{
		tag.attr("href", base_dir_default);
	}
	/** _agile_ seller logo only _agile_ **/
	if(header_logo_mode ==1)
	{
		if(id_shop_owner>0)
		{
			tag.html('<img src="' + seller_logo_url + '" height="60">');
			tag.attr("href", base_dir);
		}
	}

	/** _agile_ both main store logo and seller logo _agile_ **/
	if(header_logo_mode ==2)
	{
		tag.attr("href", base_dir_default);
		/** _agile_ if HOOK is not found _agile_ **/
		if(seller_header_logo_id != 'seller_header_logo')
			$(HOOK_SELLER_HEADER_LOGO).insertAfter(tag);
	}
});
</script>
