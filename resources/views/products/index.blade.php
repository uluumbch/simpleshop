<x-layout>


    <div class="p-4 sm:ml-64 ">
        @if (session('success'))
        <script>
            alert('{{ session('success') }}');
        </script>
        @endif

        @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                alert('{{ $error }}');
            @endforeach
        </script>
        @endif


        <a href="{{route('products.create')}}"
            class="mb-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add
            Products</a>
      


        <table class=" mt-5 drop-shadow-xl w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
            <thead class="font-medium text-xs text-blue-500 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 ">
                        Jenis
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Plat
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Penumpang
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Harga/jam
                    </th>
                    <th scope="col" class="px-6 py-3">
                        gambar
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            {{-- <tbody>

                @foreach ($kendaraans as $kendaraan)

                <tr
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                        {{$kendaraan->jenis}}
                    </th>
                    <td class="px-6 py-4">
                        <a href="/"> {{$kendaraan->plat}}</a>
                    </td>
                    <td class="px-6 py-4">
                        {{$kendaraan->penumpang}}
                    </td>
                    <td class="px-6 py-4">
                        Rp. {{$kendaraan->harga}}
                    </td>
                    <td class="px-6 py-4">
                        <img src="{{ Storage::url($kendaraan->file) }}" alt="{{ $kendaraan->file }}"
                            style="width: 100px; height: auto;">
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <form action="/{{$kendaraan->id}}" method="POST" onsubmit="return confirmDelete()">
                                @method('delete')
                                @csrf
                                <button type="submit"
                                    class="text-blue-500 bg-white border-2 border-blue-600 focus:outline-none hover:bg-blue-600 hover:text-white focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                    Hapus
                                </button>
                            </form>
                            <a href="/{{$kendaraan->id}}/edit"
                                class="text-blue-500 bg-white border-2 border-blue-600 focus:outline-none hover:bg-blue-600 hover:text-white focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                Edit
                            </a>
                            <!-- Modal Toggle Button -->
                            
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody> --}}
        </table>
        

    </div>
    <!-- Main Modal -->
    {{-- <div id="readProductModal" tabindex="-1" aria-hidden="true"
        class="hidden flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50  justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
            <!-- Modal Content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal Header -->
                <div class="flex justify-end mb-3">
                    <button type="button" id="closeModalButton"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                    <div class="text-lg text-gray-900 md:text-xl dark:text-white">
                        <img id="modalImage" src="" alt="">

                        <h3 id="modalJenis" class="font-semibold"></h3>
                        <p id="modalHarga" class="font-bold"></p>
                    </div>

                </div>
                <p>Detail</p>
                <dl>
                    <div class="flex items-center mb-2">
                        <dt class="font-semibold text-gray-900 dark:text-white mr-2">Plat:</dt>
                        <dd id="modalPlat" class="font-light text-gray-500 dark:text-gray-400">Da 2124 DS</dd>
                    </div>
                    <!-- Repeat for other details if needed -->
                    <div class="flex items-center mb-2">
                        <dt class="font-semibold text-gray-900 dark:text-white mr-2">Penumpang:</dt>
                        <dd id="modalPenumpang" class="font-light text-gray-500 dark:text-gray-400">5</dd>
                        <dd class="pl-2 font-light text-gray-500 dark:text-gray-400">Orang</dd>
                    </div>
                    <div class="flex items-center mb-2">
                        <dt class="font-semibold text-gray-900 dark:text-white mr-2">Harga /Jam:</dt>
                        <dd id="modalHarga" class="font-light text-gray-500 dark:text-gray-400">Rp. 100.000</dd>
                    </div>
                </dl>

                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-3 sm:space-x-4">

                        <!-- Edit Button -->
                        <a id="modalEditButton" href="#"
                            class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg aria-hidden="true" class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                                </path>
                                <path fill-rule="evenodd"
                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Edit
                        </a>
                    </div>

                    <form id="modalDeleteButton" action="/id" method="POST" onsubmit="return confirmDelete()">
                        @method('delete')
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            <svg aria-hidden="true" class="w-5 h-5 mr-1.5 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Hapus
                        </button>
                    </form>


                </div>
            </div>
        </div>
    </div> --}}


</x-layout>