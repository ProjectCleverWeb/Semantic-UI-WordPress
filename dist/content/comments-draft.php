<h2 class="ui dividing header" id="comments">
	Comments
</h2>
<div class="ui basic center aligned segment" id="post-comment-button">
	<button class="ui tiny right labeled icon button" onclick="$('#post-comment-button').transition({animation:'slide',duration:'250ms'});$('#main-comment-reply').transition('slide down');">
		<i class="comment icon"></i>
		Post A Comment
	</button>
</div>
<div class="ui basic segment" id="main-comment-reply" style="display:none">
	<form class="ui right aligned reply form segment" id="main-comment-form" action="#comments" method="POST">
		<div class="ui inverted dimmer">
			<div class="ui large text loader">Submitting Your Comment...</div>
		</div>
		<div class="field">
			<textarea></textarea>
		</div>
		<a href="javascript:" onclick="$('#comment-supported-html').modal('show')">Show Supported HTML <i class="code icon"></i></a>
		<button class="ui labeled submit icon button" onclick="$('#main-comment-form').dimmer('show');">
			<i class="icon edit"></i> Add Reply
		</button>
	</form>
	<h4 class="ui horizontal header divider">
		<i class="comments outline icon"></i>
	</h4>
</div>
<div class="ui threaded comments">
	<div class="comment">
		<a class="avatar">
			<img src="http://semantic-ui.com/images/avatar/small/matt.jpg">
		</a>
		<div class="content">
			<a class="author">Matt</a>
			<div class="metadata">
				<span class="date">Today at 5:42PM</span>
			</div>
			<div class="text">
				How artistic!
			</div>
			<div class="actions">
				<a class="reply">Reply</a>
				<a class="reply">Edit</a>
				<a class="reply">Delete</a>
			</div>
		</div>
	</div>
	<div class="comment">
		<a class="avatar">
			<img src="http://semantic-ui.com/images/avatar/small/elliot.jpg">
		</a>
		<div class="content">
			<a class="author">Elliot Fu</a>
			<div class="metadata">
				<span class="date">Yesterday at 12:30AM</span>
			</div>
			<div class="text">
				<p>This has been very useful for my research. Thanks as well!</p>
			</div>
			<div class="actions">
				<a class="reply">Reply</a>
				<a class="reply">Edit</a>
				<a class="reply">Delete</a>
			</div>
		</div>
		<div class="comments">
			<div class="comment">
				<a class="avatar">
					<img src="http://semantic-ui.com/images/avatar/small/jenny.jpg">
				</a>
				<div class="content">
					<a class="author">Jenny Hess</a>
					<div class="metadata">
						<span class="date">Just now</span>
					</div>
					<div class="text">
						Elliot you are always so right :)
					</div>
					<div class="actions">
						<a class="reply">Reply</a>
						<a class="reply">Edit</a>
						<a class="reply">Delete</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="comment">
		<a class="avatar">
			<img src="http://semantic-ui.com/images/avatar/small/joe.jpg">
		</a>
		<div class="content">
			<a class="author">Joe Henderson</a>
			<div class="metadata">
				<span class="date">5 days ago</span>
			</div>
			<div class="text">
				Dude, this is awesome. Thanks so much
			</div>
			<div class="actions">
				<a class="reply">Reply</a>
				<a class="reply">Edit</a>
				<a class="reply">Delete</a>
			</div>
		</div>
	</div>
</div>











<div class="ui modal" id="comment-supported-html">
	<i class="close icon"></i>
	<div class="header">
		Supported HTML
	</div>
	<div class="content">
		<table class="ui small very compact very basic celled striped table">
			<thead>
				<tr>
					<th>Tag</th>
					<th>Attributes</th>
					<th>Example</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Anchor</td>
					<td>href, title</td>
					<td>
						<code>&lt;a href=&quot;http://example.com&quot; title=&quot;Example Link&quot;&gt;example.com&lt;/a&gt;</code>
					</td>
				</tr>
				<tr>
					<td>Abbreviation</td>
					<td>title</td>
					<td>
						<code>&lt;abbr title=&quot;World Health Organization&quot;&gt;WHO&lt;/abbr&gt;</code>
					</td>
				</tr>
				<tr>
					<td>Acronym</td>
					<td>title</td>
					<td>
						<code>&lt;acronym title=&quot;HyperText Markup Language&quot;&gt;HTML&lt;/acronym&gt;</code>
					</td>
				</tr>
				<tr>
					<td>Bold</td>
					<td>-</td>
					<td>
						<code>&lt;b&gt;Bolded Text&lt;/b&gt;</code>
					</td>
				</tr>
				<tr>
					<td>Block Quote</td>
					<td>cite</td>
					<td>
						<code>&lt;blockquote cite=&quot;John Smith&quot;&gt;My name is John Smith.&lt;/blockquote&gt;</code>
					</td>
				</tr>
				<tr>
					<td>Cite</td>
					<td>-</td>
					<td>
						<code>&lt;cite&gt;John Smith&lt;/cite&gt;</code>
					</td>
				</tr>
				<tr>
					<td>Code</td>
					<td>-</td>
					<td>
						<code>&lt;code&gt;&lt;div&gt;Hello World&lt;/div&gt;&lt;/code&gt;</code>
					</td>
				</tr>
				<tr>
					<td>Delete</td>
					<td>datetime</td>
					<td>
						<code>&lt;del datetime=&quot;2011-11-15T22:55:03Z&quot;&gt;ERROR&lt;/del&gt;</code>
					</td>
				</tr>
				<tr>
					<td>Emphasis</td>
					<td>-</td>
					<td>
						<code>&lt;em&gt;Emphasized Text&lt;/em&gt;</code>
					</td>
				</tr>
				<tr>
					<td>Italic</td>
					<td>-</td>
					<td>
						<code>&lt;i&gt;Italic Text&lt;/i&gt;</code>
					</td>
				</tr>
				<tr>
					<td>Quote</td>
					<td>cite</td>
					<td>
						<code>&lt;q cite=&quot;Jane Smith&quot;&gt;My name is Jane Smith&lt;/q&gt;</code>
					</td>
				</tr>
				<tr>
					<td>Strike</td>
					<td>-</td>
					<td>
						<code>&lt;strike&gt;Undo&lt;/strike&gt;</code>
					</td>
				</tr>
				<tr>
					<td>Strong</td>
					<td>-</td>
					<td>
						<code>&lt;strong&gt;Strong Text&lt;/strong&gt;</code>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="actions">
		<div class="ui positive button">Got It</div>
	</div>
</div>












