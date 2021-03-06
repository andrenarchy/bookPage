{**
 * templates/frontend/pages/catalog.tpl
 *
 * Copyright (c) 2014-2016 Simon Fraser University Library
 * Copyright (c) 2003-2016 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @brief Display the page to view the catalog.
 *
 * @uses $publishedMonographs array List of published monographs
 *}
{include file="frontend/components/header.tpl" pageTitle="navigation.catalog"}

<div class="page page_catalog">
	{include file="frontend/components/breadcrumbs.tpl" currentTitleKey="navigation.catalog"}
	
	<div class="monograph_count">
		{translate key="catalog.browseTitles" numTitles=$publishedMonographs|@count}
	</div>

	{* No published titles *}
	{if !$publishedMonographs|@count}
		<h1>
			{translate key="catalog.allBooks"}
		</h1>
		<p>{translate key="catalog.noTitles"}</p>

	{* Monograph List *}
	{else}
		<h1>
			{translate key="catalog.allBooks"}
		</h1>
		
		{include file="../plugins/generic/bookPage/templates/monographList.tpl" monographs=$publishedMonographs featured=$featuredMonographIds}
	{/if}

</div><!-- .page -->

{include file="common/frontend/footer.tpl"}
