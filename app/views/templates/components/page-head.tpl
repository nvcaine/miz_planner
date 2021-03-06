<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<title>{$title}</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">-->
	
	<link href="{$appURL}/libs/material/css/roboto.min.css" rel="stylesheet">
	<link href="{$appURL}/libs/material/css/material.min.css" rel="stylesheet">
	<link href="{$appURL}/libs/material/css/ripples.min.css" rel="stylesheet">

	{if isset($includeSchedule)}
	<link href="{$appURL}libs/schedule-template/css/schedule-template.css" rel="stylesheet">
	{/if}

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:600' rel='stylesheet' type='text/css'>

	{if isset($includeDatepicker)}
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css">
	<link href="{$appURL}/libs/datetimepicker/datetimepicker.min.css" rel="stylesheet">
	{/if}

	<link rel="icon" type="image/png" sizes="96x96" href="{$appURL}assets/favicon.png">
	{if isset($styles)}
		{foreach from=$styles item=style}
			<link href="{$appURL}{$style}" rel="stylesheet">
		{/foreach}
	{/if}
</head>