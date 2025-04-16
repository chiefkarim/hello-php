<?php

$header = "Todo";
view("partials/head.php", ["header" => $header]);
?>
<form method="POST" action="/todo" >
<div class="col-span-full">
          <label for="about" class="block text-sm/6 font-medium text-gray-900">Edit Todo</label>
          <div class="mt-2">
            <textarea name="title" id="about" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"><?php echo $todo['title']; ?></textarea>
          </div>
        </div>
                    <input type="hidden" name="id" value="<?php echo $todo['id']; ?>">
                    <input type="hidden" name="_method" value="PATCH">
  <div class="mt-6 flex items-center justify-end gap-x-6">
    <a href="/todos" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
  </div>
  <?php foreach ($errors as $error): ?>
             <p class="py-2 text-red-500"><?php echo $error; ?></p>
           <?php endforeach; ?>
                </form>
   
 
<?php
view("partials/footer.php");
