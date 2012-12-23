<?php
/**
 * Metadata version
 */
$sMetadataVersion = '1.1';
 
/**
 * Module information
 */
$aModule = array(
    'id'           => 'ppg_additionalparams',
    'title'        => 'Additional PersParams',
    'description'  => array(
        'de' => 'Modul um bestimmten Artikeln zusätzliche freitext-Patemeter zu vergeben. Auf Basis von "PersParams".',
        'en' => 'Module for additional text parameters for Articles. Basend on "PersParams".',
    ),
    'thumbnail'    => '',
    'version'      => '0.2',
    'author'       => 'Paul Gaida',
    'url'          => 'http://www.paramente-gaida.de',
    'email'        => 'info@paramente-gaida.de',
    'extend'       => array(
        'oxarticle'        => 'ppg_additionalparams/ppg_addparams_oxarticles',
        'oxcmp_basket'     => 'ppg_additionalparams/ppg_addparams_oxcmp_basket',
    ),
    'blocks' => array(
        array('template' => 'article_extend.tpl', 'block'=>'admin_article_extend_form','file'=>'out/blocks/admin_article_extend_form.tpl'),
        array('template' => 'page/details/inc/productmain.tpl', 'block'=>'details_productmain_persparams','file'=>'out/blocks/details_productmain_persparams.tpl'),
        array('template' => 'page/checkout/inc/basketcontents.tpl', 'block'=>'checkout_basketcontents_basketitem_titlenumber','file'=>'out/blocks/checkout_basketcontents_basketitem_titlenumber.tpl')
    ),
);
?>