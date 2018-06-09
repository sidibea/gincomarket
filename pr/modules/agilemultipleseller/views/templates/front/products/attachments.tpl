<script type="text/javascript">

  $('document').ready(function() {
  tinySetup(
  {
  selector: ".rte" ,
  toolbar1 : "code,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,|,blockquote,colorpicker,pasteword,|,bullist,numlist,|,outdent,indent,|,link,unlink,|,cleanup"
  });

  $("#addAttachment").live('click', function() {
  $("#selectAttachment2 option:selected").each(function(){
  var val = $('#arrayAttachments').val();
  var tab = val.split(',');
  for (var i=0; i < tab.length; i++)
					if (tab[i] == $(this).val())
						return false;
				$('#arrayAttachments').val(val+$(this).val()+',');
			});
			return !$("#selectAttachment2 option:selected").remove().appendTo("#selectAttachment1");
		});
		$("#removeAttachment").live('click', function() {
			$("#selectAttachment1 option:selected").each(function(){
				var val = $('#arrayAttachments').val();
				var tab = val.split(',');
				var tabs = '';
				for (var i=0; i < tab.length; i++)
					if (tab[i] != $(this).val())
					{
						tabs = tabs+','+tab[i];
						$('#arrayAttachments').val(tabs);
					}
			});
			return !$("#selectAttachment1 option:selected").remove().appendTo("#selectAttachment2");
		});
		$("#product").submit(function() {
			$("#selectAttachment1 option").each(function(i) {
				$(this).attr("selected", "selected");
			});
		});
	});
				
	function changeMyLanguage(field, fieldsString, id_language_new, iso_code)
	{
		changeLanguage(field, fieldsString, id_language_new, iso_code);
		$("img[id^='language_current_']").attr("src","{$base_dir}img/l/" + id_language_new + ".jpg");
	}

</script>
{if isset($product->id)}
  <div id="product-attachements" class="panel product-tab">
    <input type="hidden" name="submitted_tabs[]" value="Attachments" />
    <h3>{l s='Attachment' mod='agilemultipleseller'}</h3>

    <div class="form-group ">
      <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3 required" for="attachment_name_{$id_language}">
        <span class="label-tooltip" data-toggle="tooltip"
        title="{l s='Maximum 32 characters.' mod='agilemultipleseller'}">
          {l s='Filename:' mod='agilemultipleseller'}
        </span>
      </label>
      <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
        {include file="$agilemultipleseller_views/templates/front/products/input_text_lang.tpl"
        languages=$languages
        input_value=$attachment_name
        input_name="attachment_name"
        }
      </div>
    </div>

    <div class="form-group ">
      <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="attachment_description_{$id_language}">{l s='Description:' mod='agilemultipleseller'} </label>
      <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
        <div class="row">
          {include file="$agilemultipleseller_views/templates/front/products/textarea_lang.tpl"
          languages=$languages
          input_name="attachment_description"
          input_value=$attachment_description
          class="rte"
          }
        </div>
      </div>
    </div>

    <div class="form-group ">
      <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="attachement_filename">
        <span class="label-tooltip" data-toggle="tooltip"
          title="{l s='Upload a file from your computer' mod='agilemultipleseller'} ({$PS_ATTACHMENT_MAXIMUM_SIZE|string_format:'%.2f'} {l s='MB max.'  mod='agilemultipleseller'})">
          {l s='File:'  mod='agilemultipleseller'}
        </span>
      </label>
      <div class="agile-col-md-8 agile-col-lg-8 agile-col-xl-8">
        <div class="row">
          <div class="agile-col-sm-8 agile-col-md-8 agile-col-lg-8 agile-col-xl-8">
            <input id="attachment_file" name="attachment_file" type="file" />
         </div>
          <div class="agile-col-sm-4 agile-col-md-4 agile-col-lg-4 agile-col-xl-4">
            <button type="submit" class="agile-btn agile-btn-default" name="submitAddAttachments" value="{l s='Upload attachment file' mod='agilemultipleseller'}">
              <i class="icon-upload "></i>&nbsp;<span>{l s='Upload' mod='agilemultipleseller'}</span>
            </button >
          </div>
        </div>
      </div>
    </div>
    
    <div class="form-group  agile-padding"></div>
    
    <div class="form-group ">
      <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" ></label>
      <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
        <div class="row">
          <div class="agile-col-md-6 agile-col-lg-6 agile-col-xl-6">
            <p>{l s='Available attachments:'  mod='agilemultipleseller'}</p>
            <select multiple="" id="selectAttachment2">
              {foreach $attach2 as $attach}
              <option value="{$attach.id_attachment}">{$attach.name}</option>
              {/foreach}
            </select>
            <a href="#" id="addAttachment" class="agile-btn agile-btn-default btn-block">
              {l s='Add'  mod='agilemultipleseller'}&nbsp;<i class="icon-arrow-right"></i>
            </a>
          </div>
          <div class="agile-col-md-6 agile-col-lg-6 agile-col-xl-6">
            <p>{l s='Attachments for this product:'  mod='agilemultipleseller'}</p>
            <select multiple="" id="selectAttachment1" name="attachments[]">
              {foreach $attach1 as $attach}
              <option value="{$attach.id_attachment}">{$attach.name}</option>
              {/foreach}
            </select>
            <a href="#" id="removeAttachment" class="agile-btn agile-btn-default btn-block">
              <i class="icon-arrow-left"></i>&nbsp;{l s='Remove'  mod='agilemultipleseller'}
            </a>
          </div>
        </div>
      </div>
    </div>
    
    <div class="form-group  agile-align-center agile-padding">
      <input type="hidden" name="arrayAttachments" id="arrayAttachments" value="{foreach $attach1 as $attach}{$attach.id_attachment},{/foreach}" />
      <button type="submit" class="agile-btn agile-btn-default" name="submitAttachments" value="{l s='Save' mod='agilemultipleseller'}">
        <i class="icon-save "></i>&nbsp;<span>{l s='Save' mod='agilemultipleseller'}</span>
      </button >

    </div>

    <script type="text/javascript">
      var iso = "{$isoTinyMCE}";
      var pathCSS = '{$smarty.const._THEME_CSS_DIR_}';
      var ad = "{$ad}";
      hideOtherLanguage({$id_language});
    </script>
  </div>
{/if}
