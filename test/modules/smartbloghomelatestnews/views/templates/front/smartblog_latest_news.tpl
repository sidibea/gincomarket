{if isset($view_data) AND !empty($view_data)}
<div class="col-xs-12">
<div class="home_blog">
    <div class="title_block">
		<a class="blog_lnk" href="{smartblog::GetSmartBlogLink('smartblog')}">{l s='The Blog' mod='smartbloghomelatestnews'}</a> 
		<div class="navi">
			<a class="prevtab"><i class="icon-chevron-left"></i></a>
			<a class="nexttab"><i class="icon-chevron-right"></i></a>
		</div>
	</div>
    <div class="block_content">
		<div class="row">
			<div class="blogSlider">
					{assign var='i' value=1}
					{foreach from=$view_data item=post name=myLoop}
						{if $smarty.foreach.myLoop.index % 1 == 0 || $smarty.foreach.myLoop.first }
								<div class="item_out">
							{/if}
							{assign var="options" value=null}
							{$options.id_post = $post.id}
							{$options.slug = $post.link_rewrite}
							<div class="blog_item">
								<div class="blog_img_holder">
									 <a href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}"><img alt="{$post.title}" class="feat_img_small img-responsive" src="{$modules_dir}smartblog/images/{$post.post_img}-home-default.jpg"></a>
								</div>
								<div class="date_added">
									<span class="date_added">{$post.date_added}</span>
								</div>
								<div class="blog_info">
									<a class="post_title" href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}">{$post.title}</a>
									<p class="desc">
										{$post.short_description|escape:'htmlall':'UTF-8'|truncate:100:'...'}
									</p>
									 <a href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}" class="read_more">
										{l s='Read more' mod='smartbloghomelatestnews'}
										<i class="icon-arrow-right"></i>
									 </a>
								</div>
							</div>
						{if $smarty.foreach.myLoop.iteration % 1 == 0 || $smarty.foreach.myLoop.last}
								</div>
							{/if}
						{$i=$i+1}
					{/foreach}
			 </div>
		 </div>
     </div>
</div>
</div>
<script>
	$(document).ready(function() {
		var blogSlider = $(".blogSlider");
		blogSlider.owlCarousel({
			items : 3,
			itemsDesktop : [1199,2],
			itemsDesktopSmall : [991,2], 
			itemsTablet: [767,2], 
			itemsMobile : [480,1],
			autoPlay :  false,
			stopOnHover: false,
		});
		
		// Custom Navigation Events
		$(".home_blog .nexttab").click(function(){
		blogSlider.trigger('owl.next');})
		$(".home_blog .prevtab").click(function(){
		blogSlider.trigger('owl.prev');})   
	});
</script>
{/if}