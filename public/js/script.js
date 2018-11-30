window.onload = init;

function init() {
	// var add_button = document.getElementById("add_todo");
	// add_button.addEventListener('click', handleAddTodoClick);
}

function handleAddTodoClick() {
	var todoInput = document.getElementById("input_todo");
	var todoItem = todoInput.value;

	if (todoItem == "") {
		alert('Please enter the todo item.');
	} else {
		appendNewTodoItem(todoItem);
	}
}

function appendNewTodoItem(name) {
	var li = document.createElement("li");
	li.innerHTML = name;
	li.setAttribute('class', 'item');

	var ul = document.getElementById("todo_list");
	ul.appendChild(li);
}