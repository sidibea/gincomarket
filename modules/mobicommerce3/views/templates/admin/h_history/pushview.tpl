{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}

<div class="col-lg-12">
	<div class="panel">
		<h3>
			<i class="icon-info"></i>
			{l s='Information'}
		</h3>
		<p>
			<strong>{l s='ID:'}</strong> {$details.id}
		</p>
		<p>
			<strong>{l s='Device Type:'}</strong> {$deviceType}
		</p>
		<p>
			<strong>{l s='Heading:'}</strong> {$details.heading}
		</p>
		<p>
			<strong>{l s='Message:'}</strong> {$details.message}
		</p>
		<p>
			<strong>{l s='Deeplink:'}</strong> {$details.deeplink}
		</p>
		<p>
			<strong>{l s='Sent To:'}</strong> {$sentTo}
		</p>

		{if $sent_to_result}
			<p>
				<table class="table">
					<thead>
						<tr>
							<th><span class="title_box">{l s='ID'}</span></th>
							<th><span class="title_box">{l s='Name'}</span></th>
						</tr>
					</thead>
					<tbody>
						{foreach from=$sent_to_result item=_sent_to_result}
							<tr>
								<td>{$_sent_to_result.id}</td>
								<td>{$_sent_to_result.name}</td>
							</tr>
						{/foreach}
					</tbody>
				</table>
			</p>
		{/if}
		<p>
			<strong>{l s='Sent Date:'}</strong> {$details.date_submitted|date_format:"%Y-%m-%d %H:%M:%S"}
		</p>
		{if $details.image}
			<p>
				<img src="{$details.image}" alt="No image" height="100" />
			</p>
		{/if}
	</div>
</div>