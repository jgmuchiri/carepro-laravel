<tr>
	<td>
		<table class="footer" align="center" width="570" cellpadding="0" cellspacing="0">
			<tr>
				<td class="content-cell" align="center">
					{{ Illuminate\Mail\Markdown::parse($slot) }}
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td class="content-block">
		<span class="apple-link">{{ \Config::get('app.name') }}</span>
		<br>
	</td>
</tr>
<tr>
	<td class="content-block powered-by">
		{{ URL()->to('/') }}
	</td>
</tr>