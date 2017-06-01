<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>-->

{if isset($includeDatepicker)}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<script src="{$appURL}/libs/datetimepicker/datetimepicker.min.js"></script>
{/if}

<script src="{$appURL}/libs/material/js/ripples.min.js"></script>
<script src="{$appURL}/libs/material/js/material.min.js"></script>

{if isset($includeSchedule)}
<script src="{$appURL}/libs/schedule-template/js/modernizr.js"></script>
<script src="{$appURL}/libs/schedule-template/js/schedule-template.js"></script>
{/if}

{if isset($scripts)}
	{foreach from=$scripts item=script}
		<script src="{$appURL}{$script}"></script>
	{/foreach}
{/if}
