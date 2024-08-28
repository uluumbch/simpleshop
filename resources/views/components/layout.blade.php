<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class="h-full">
  
    <!--
  This example requires updating your template:

  ```
  <html class="h-full bg-gray-100">
  <body class="h-full">
  ```
-->
<x-sidebar></x-sidebar>

<div class="min-h-full">
    <main>
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      {{$slot}}
      </div>
    </main>
  </div>
  {{-- <x-footer></x-footer> --}}
  <script src="../path/to/flowbite/dist/flowbite.min.js"></script>


</body>
</html>