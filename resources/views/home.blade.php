@extends('layouts.view')

@section('content')

<div class="py-12">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 dark:text-gray-100">
              {{ __("You're logged in!") }}
          </div>
      </div>
  </div>
</div>

<div class="container max-w-xl px-20 mx-auto text-gray-900 flex items-center">
    <div class="">
    <button id="resetButton">Reset</button>
    </div>
      
</div>

<div class="container max-w-2xl mx-auto text-gray-900 flex justify-center ">
  <table class="border shadow rounded border-separate ">
    <tr class="">
      <th class="px-5">M</th>
      <td class="cell border p-2" data-row="1" data-col="1">MC1</td>
      <td class="cell border p-2" data-row="1" data-col="2">MC2</td>
      <td class="cell border p-2" data-row="1" data-col="3">MC3</td>
      <td class="cell border p-2" data-row="1" data-col="4">MC4</td>
      <td class="cell border p-2" data-row="1" data-col="5">MC5</td>
      <td class="cell border p-2" data-row="1" data-col="6">MC6</td>
    </tr>
    <tr>
      <th>P</th>
      <td class="cell border p-2" data-row="2" data-col="1">PC1</td>
      <td class="cell border p-2" data-row="2" data-col="2">PC2</td>
      <td class="cell border p-2" data-row="2" data-col="3">PC3</td>
      <td class="cell border p-2" data-row="2" data-col="4">PC4</td>
      <td class="cell border p-2" data-row="2" data-col="5">PC5</td>
      <td class="cell border p-2" data-row="2" data-col="6">PC6</td>
    </tr>
    <tr>
      <th>C</th>
      <td class="cell border p-2" data-row="3" data-col="1">CC1</td>
      <td class="cell border p-2" data-row="3" data-col="2">CC2</td>
      <td class="cell border p-2" data-row="3" data-col="3">CC3</td>
      <td class="cell border p-2" data-row="3" data-col="4">CC4</td>
      <td class="cell border p-2" data-row="3" data-col="5">CC5</td>
      <td class="cell border p-2" data-row="3" data-col="6">CC6</td>
    </tr>
    <tr>
      <th>F</th>
      <td class="cell border p-2" data-row="4" data-col="1">FC1</td>
      <td class="cell border p-2" data-row="4" data-col="2">FC2</td>
      <td class="cell border p-2" data-row="4" data-col="3">FC3</td>
      <td class="cell border p-2" data-row="4" data-col="4">FC4</td>
      <td class="cell border p-2" data-row="4" data-col="5">FC5</td>
      <td class="cell border p-2" data-row="4" data-col="6">FC6</td>
    </tr>
    <tr>
      <th class="py-5"></th>
      <th>C1</th>
      <th>C2</th>
      <th>C3</th>
      <th>C4</th>
      <th>C5</th>
      <th>C6</th>
    </tr>
  </table>
</div>

    


<script>
// Get all the cells
const cells = document.querySelectorAll('.cell');

cells.forEach((cell) => {
  cell.classList.add('clickable');
});


cells.forEach((cell) => {
  cell.addEventListener('click', () => {
    if (!cell.classList.contains('clickable')) {
      return;
    }
    cells.forEach((cell) => {
      if (!cell.classList.contains('highlight')) {
        cell.classList.remove('blue', 'clickable');
      }
    });

    cell.classList.add('highlight');

    const row = parseInt(cell.getAttribute('data-row'));
    const col = parseInt(cell.getAttribute('data-col'));

    let nextRow, nextCol;
    if (col === 6) {
      nextRow = null;
      nextCol = 1;
    } else {
      nextRow = row;
      nextCol = col + 1;
    }

    const nextCells = [
      document.querySelector(`[data-row="${nextRow}"][data-col="${nextCol}"]`),
      document.querySelector(`[data-row="${row - 1}"][data-col="${col}"]`)
    ].filter(cell => cell);

    nextCells.forEach((cell) => {
      cell.classList.add('clickable', 'blue');
    });

    cells.forEach((cell) => {
      if (!cell.classList.contains('clickable')) {
      }
    });
  });
});

// Reset button
const resetButton = document.querySelector('#resetButton');
resetButton.addEventListener('click', () => {
  // Remove all classes from all cells
  cells.forEach((cell) => {
    cell.classList.remove('clickable', 'blue', 'highlight');
  });

  // Add the clickable class to all cells
  cells.forEach((cell) => {
    cell.classList.add('clickable');
  });
});


</script>
@endsection