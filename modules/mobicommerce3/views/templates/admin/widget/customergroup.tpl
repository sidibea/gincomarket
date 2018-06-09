{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}

<div class="table-responsive-row clearfix">
    <table class="table group">
        <thead>
            <tr class="nodrag nodrop">
                <th class="fixed-width-xs center"></th>
                <th class="fixed-width-xs center">
                    <span class="title_box">
                        {l s='ID'}
                    </span>
                </th>
                <th class="">
                    <span class="title_box">
                        {l s='Group name'}
                    </span>
                </th>
                <th></th>
            </tr>
            <tr class="nodrag nodrop filter row_hover">
                <th></th>
                <th class="center">
                    <input class="filter" name="groupFilter_id_group" value="{$filter_id}" type="text">
                </th>
                <th>
                    <input class="filter" name="groupFilter_name" value="{$filter_name}" type="text">
                </th>
                <th class="actions">
                    <span class="pull-right">
                        <button type="button" name="submitFilter" class="btn btn-default" data-list-id="group" onclick="filterCustomerGroup()">
                            <i class="icon-search"></i> {l s='Search'}
                        </button>
                    </span>
                </th>
            </tr>
        </thead>
        <tbody>
            {foreach $groups item=group}
                <tr>
                    <td class="pointer fixed-width-xs center">
                        <input name="customergroup[{$group.id_group}]" type="checkbox" onclick="checkCustomerGroup('{$group.id_group}');" {if in_array($group.id_group, $ids_customer_group)}checked="checked"{/if} />
                    </td>
                    <td class="pointer fixed-width-xs center">{$group.id_group}</td>
                    <td class="pointer customergroupgrid_name">{$group.name}</td>
                    <td></td>
                </tr>
            {/foreach}
        </tbody>
    </table>

    {if $totalPages > 1}
        <ul class="pagination pull-right">
            {for $i=1 to $totalPages}
                <li>
                    <a href="javascript:void(0);" onclick="pushPaginationCustomerGroup('{$i}');" class="pagination-link" data-page="{$i}">{$i}</a>
                </li>
            {/for}
        </ul>
    {/if}
</div>