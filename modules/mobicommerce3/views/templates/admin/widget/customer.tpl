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
                        {l s='First name'}
                    </span>
                </th>
                <th class="">
                    <span class="title_box">
                        {l s='Last name'}
                    </span>
                </th>
                <th class="">
                    <span class="title_box">
                        {l s='Email'}
                    </span>
                </th>
                <th></th>
            </tr>
            <tr class="nodrag nodrop filter row_hover">
                <th></th>
                <th class="center">
                    <input class="filter" name="customerFilter_id" value="{$filter_id}" type="text">
                </th>
                <th>
                    <input class="filter" name="customerFilter_firstname" value="{$filter_firstname}" type="text">
                </th>
                <th>
                    <input class="filter" name="customerFilter_lastname" value="{$filter_lastname}" type="text">
                </th>
                <th>
                    <input class="filter" name="customerFilter_email" value="{$filter_email}" type="text">
                </th>
                <th class="actions">
                    <span class="pull-right">
                        <button type="button" name="submitFilter" class="btn btn-default" data-list-id="group" onclick="filterCustomer()">
                            <i class="icon-search"></i> {l s='Search'}
                        </button>
                    </span>
                </th>
            </tr>
        </thead>
        <tbody>
            {foreach $customers item=customer}
                <tr>
                    <td class="pointer fixed-width-xs center">
                        <input name="customer[{$customer.id_customer}]" type="checkbox" onclick="checkCustomer('{$customer.id_customer}');" {if in_array($customer.id_customer, $ids_customer)}checked="checked"{/if} />
                    </td>
                    <td class="pointer fixed-width-xs center">{$customer.id_customer}</td>
                    <td class="pointer customergrid_firstname">{$customer.firstname}</td>
                    <td class="pointer">{$customer.lastname}</td>
                    <td class="pointer">{$customer.email}</td>
                    <td></td>
                </tr>
            {/foreach}
        </tbody>
    </table>

    {if $totalPages > 1}
        <ul class="pagination pull-right">
            {for $i=1 to $totalPages}
                <li>
                    <a href="javascript:void(0);" onclick="pushPaginationCustomer('{$i}');" class="pagination-link" data-page="{$i}">{$i}</a>
                </li>
            {/for}
        </ul>
    {/if}
</div>