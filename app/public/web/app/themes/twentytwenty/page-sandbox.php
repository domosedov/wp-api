<?php

use Domosedov\WPAPI\Models\Todo;
use RedBeanPHP\R;

get_header();
?>
<div id="todo">

</div>
<button id="get-todo">Get Todo</button>
	<script>
		document.getElementById('get-todo').addEventListener('click', e => {
		    e.preventDefault();
			const div = document.getElementById('todo');
		    fetch('http://localhost:10011/wp-json/domosedov/v1/todos/14', {
				method: 'GET',
			    headers: {
                    'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6MTAwMTEiLCJpYXQiOjE1OTM4MDQyNzYsIm5iZiI6MTU5MzgwNDI3NiwiZXhwIjoxNTk0NDA5MDc2LCJkYXRhIjp7InVzZXIiOnsiaWQiOiIxIn19fQ.RG8HCRrP_UMlFxQSNTHXgcWeWcRlhPD-yBMUKSb3jqs',
			    }
		    })
			.then(response => response.json())
			.then(todo => {
			    div.innerHTML = `
			        <b>${todo.id}</b>
					<h1>${todo.text}</h1>
			    `;
			})
			.catch(err => console.log(err));
		})
	</script>

<?php get_footer();