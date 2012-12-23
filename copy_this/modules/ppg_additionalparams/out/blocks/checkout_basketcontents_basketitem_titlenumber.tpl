[{* product title & number *}]
                        <td>
                            <div>
                                <a rel="nofllow" href="[{$basketitem->getLink()}]"><b>[{$basketitem->getTitle()}]</b></a>[{if $basketitem->isSkipDiscount() }] <sup><a rel="nofollow" href="#SkipDiscounts_link" >**</a></sup>[{/if}]
                            </div>
                            <div class="smallFont">
                                [{ oxmultilang ident="PAGE_CHECKOUT_BASKETCONTENTS_ARTNOMBER" }] [{ $basketproduct->oxarticles__oxartnum->value }]
                            </div>
                            <div class="smallFont">
                                [{assign var=sep value=", "}]
                                [{assign var=result value=""}]
                                [{foreach key=oArtAttributes from=$oAttributes->getArray() item=oAttr name=attributeContents}]
                                    [{assign var=temp value=$oAttr->oxattribute__oxvalue->value}]
                                    [{assign var=result value=$result$temp$sep}]
                                [{/foreach}]
                                <b>[{$result|trim:$sep}]</b>
                            </div>

                            [{if !$basketitem->isBundle() || !$basketitem->isDiscountArticle()}]
                                [{if $oViewConf->showSelectListsInList()}]
                                    [{assign var="oSelections" value=$basketproduct->getSelections(null,$basketitem->getSelList())}]
                                    [{if $oSelections}]
                                        <div class="selectorsBox clear" id="cartItemSelections_[{$smarty.foreach.basketContents.iteration}]">
                                            [{foreach from=$oSelections item=oList name=selections}]
                                                [{include file="widget/product/selectbox.tpl" oSelectionList=$oList sFieldName="aproducts[`$basketindex`][sel]" iKey=$smarty.foreach.selections.index blHideDefault=true sSelType="seldrop"}]
                                            [{/foreach}]
                                        </div>
                                    [{/if}]
                                [{/if}]
                            [{/if }]

[{* BOF Changes because of more parameters that must be shown in the basket *}]
                            [{if !$editable }]
                                <p class="persparamBox">
                                    [{foreach key=sVar from=$basketitem->getPersParams() item=aParam name=persparams }]
                                        [{if !$smarty.foreach.persparams.first}]<br />[{/if}]
                                        <strong>
                                            [{if $sVar=="details"}]
                                                [{ oxmultilang ident="PPG_ADDPARAMS_LABEL" }]:
                                            [{else}]
                                                [{ $sVar }]:
                                            [{/if}]
                                        </strong> [{ $aParam }]
                                    [{/foreach}]
                                </p>
                            [{else}]
                                [{if $basketproduct->oxarticles__oxisconfigurable->value}]
                                    [{if $basketitem->getPersParams()}]
                                        <table style="border:0px !important;border-collapse:separate;border-spacing:1px;">
                                        [{foreach key=sVar from=$basketitem->getPersParams() item=aParam name=persparams }]
                                            <tr style="border:0px !important;">
                                                <td style="border:0px !important;text-align:right;">
                                                    [{if $sVar=="details"}]
                                                        [{ oxmultilang ident="PPG_ADDPARAMS_LABEL" }]:
                                                    [{else}]
                                                        [{ $sVar }]:
                                                    [{/if}]
                                                </td>
                                                <td style="border:0px !important;"><input class="textbox persParam" type="text" name="aproducts[[{ $basketindex }]][persparam][[{ $sVar }]]" value="[{ $aParam }]"></td>
                                            </tr>
                                        [{/foreach }]
                                        </table>
                                    [{else}]
                                         <p>[{ oxmultilang ident="LABEL" }] <input class="textbox persParam" type="text" name="aproducts[[{ $basketindex }]][persparam][details]" value=""></p>
                                    [{/if}]
                                [{/if}]
                            [{/if}]
[{* EOF Changes because of more parameters that must be shown in the basket *}]
                        </td>