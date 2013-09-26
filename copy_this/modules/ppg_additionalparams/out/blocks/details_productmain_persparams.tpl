[{if $oDetailsProduct->oxarticles__oxaddparams->value != "" && $oView->isPersParam()}]
  [{assign var=addparams value=$oDetailsProduct->oxarticles__oxaddparams->value}]
    <h3 style="line-height:50%;">[{oxmultilang ident="PPG_ADDPARAMS_TITLE_PRODUCTINFO"}]</h3>
    [{assign var=addparams_array value=$oDetailsProduct->explodeaddparams($addparams)}]    
    
    <table style="border-collapse:separate;border-spacing:2px;">
    [{foreach from=$addparams_array item=param_name}]

[{* Fields for every additional parameter defined in Article Extend Form *}]      
      <tr style="margin:1px 0px !important;">
        <td style="text-align:right;">[{ $param_name }]:</td>
        <td><input type="text" id="persistentParam" name="persparam[[{$param_name}]]" value="[{ $oDetailsProduct->aPersistParam.text }]" size="25"></td>
      </tr>
      
    [{/foreach}]
[{* Field with the usual notice textarea, but fitted to the addparams layout *}]      
      <tr>
        <td style="text-align:right;vertical-align:top;">[{ oxmultilang ident="PPG_ADDPARAMS_LABEL" }]:</td>
        <td><textarea id="persistentParam" name="persparam[details]" cols="35" rows="3">[{ $oDetailsProduct->aPersistParam.text }]</textarea></td>
      </tr>
      
    </table>
    
[{else}]
[{$smarty.block.parent}]  
[{/if}]
