<%-- <% require css('derralf/elemental-styles-extension: client/dist/styles/margin-bottom-variants.css') %> --%>
<div class="element $SimpleClassName.LowerCase<% if $StyleVariant %> $StyleVariant<% end_if %><% if $ExtraClass %> $ExtraClass<% end_if %><% if $MarginBottomVariant %> $MarginBottomVariant<% end_if %><% if $MarginTopVariant %> $MarginTopVariant<% end_if %>" id="$Anchor" data-cmseditlink="$FrontendCMSEditLink.ATT" style="{$CustomInlineStyles.ATT}">
	$Element
</div>
