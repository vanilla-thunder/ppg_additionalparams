[{$smarty.block.parent}]
<!-- Field to define of additional text parameters -->              
<tr>
    <td class="edittext" width="140">
        [{ oxmultilang ident="ARTICLE_EXTEND_ADDPARAMETERS" }]
    </td>
    <td class="edittext">
        <input type="text" class="editinput" size="25" maxlength="[{$edit->oxarticles__oxaddparams->fldmax_length}]" name="editval[oxarticles__oxaddparams]" value="[{$edit->oxarticles__oxaddparams->value}]" [{ $readonly }]>
        [{ oxinputhelp ident="HELP_ARTICLE_EXTEND_ADDOARAMETERS" }]
    </td>
</tr>