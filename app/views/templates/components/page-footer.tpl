<!-- modules -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>-->
<!--<script src="{$appURL}libs/jQuery.1.11.0/jquery-1.11.0.min.js"></script>
<script src="{$appURL}libs/bootstrap-3.3.5/js/bootstrap.min.js"></script>-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="{$appURL}/libs/material/js/ripples.min.js"></script>
<script src="{$appURL}/libs/material/js/material.min.js"></script>

{if isset($scripts)}
	{foreach from=$scripts item=script}
		<script src="{$appURL}{$script}"></script>
	{/foreach}
{/if}
