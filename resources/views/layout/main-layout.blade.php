
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Auth System</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/pricing/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.11/dist/clipboard.min.js"></script>
   
    <style>
      ./* Style dasar untuk toast */
      .toast {
          opacity: 0;
          transition: opacity 0.5s ease; /* Transisi untuk efek memudar */
      }

      /* Kelas aktif untuk menampilkan toast */
      .toast.active {
          opacity: 1;
      }

      /* Kelas untuk efek memudar sebelum menghilang */
      .toast.fade-out {
          opacity: 0;
      }

  </style>
    
  </head>
  <body>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
      <img src="{{ asset('logo.jpeg') }}" class="h-8 my-0 mr-md-auto" alt="Flowbite Logo" />
        {{-- <h5 class="my-0 mr-md-auto font-weight-normal">Tixetux</h5> --}}
        <nav class="my-2 my-md-0 mr-md-3 top-nav">
          <a class="p-2 text-dark {{(request()->route()->getName()=='home')?'active':''}}" href="{{route('home')}}">Home</a>

          @if(!auth()->check())
          <a class="p-2 text-dark {{(request()->route()->getName()=='telegram') || (request()->route()->getName()=='dokumentasi')?'active':''}}" href="{{route('telegram')}}">Doc Telegram</a>
          @endif

          @if(!auth()->check())
          <a class="p-2 text-dark {{(request()->route()->getName()=='getValidasi')?'active':''}}" href="{{route('getValidasi')}}">Validasi</a>
          @endif

          @if(!auth()->check())
          <a class="p-2 text-dark {{(request()->route()->getName()=='getLogin')?'active':''}}" href="{{route('getLogin')}}">Login</a>
          @endif

          @if(auth()->check())
          <a class="p-2 text-dark 
          @if (request()->route()->getName()=='dashboard')
            active
          @endif
          @if (request()->route()->getName()=='edit_profile')
            active
          @endif
          @if (request()->route()->getName()=='change_password')
          active
          @endif
          " href="{{route('dashboard')}}">Profile</a>
          <a class="p-2 text-dark" href="{{route('logout')}}">Logout</a>
          @endif
        </nav>
          @if(!auth()->check())
          <a class="btn btn-outline-primary {{(request()->route()->getName()=='getRegister')?'active':''}}" href="{{route('getRegister')}}">Sign up</a>
          @endif
      </div>
      
      
      <div class="container-fluid" style="min-height:74vh;">
        
        @yield('body')

        @if (session('success'))
            <div id="toast-success" class="fixed flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rtl divide-gray-200 rounded-lg shadow top-5 right-5 dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800" role="alert">
                <div class="progress"></div>
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">{{ session('success') }}</div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div id="toast-danger" class="fixed flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rtl divide-gray-200 rounded-lg shadow top-5 right-5 dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800" role="alert">
                <div class="progress"></div>
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                    </svg>
                    <span class="sr-only">Error icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">
                  <div class="ms-3 text-sm font-normal">{{ session('error') }}</div>

                </div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
        @endif


      </div>

    <br>

  <footer class="bg-white rounded-lg shadow dark:bg-gray-900">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="https://flowbite.com/" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('logo.jpeg') }}" class="h-8" alt="Flowbite Logo" />
                {{-- <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Tiketux</span> --}}
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">About</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Contact</a>
                </li>
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="https://flowbite.com/" class="hover:underline">Flowbite™</a>. All Rights Reserved.</span>
    </div>
</footer>
  


<script type="text/javascript">
   window.baseUrl = "{{ url('/') }}";
  //  @if (session('success'))
  //   swal("Success", "{{ session('success') }}", "success");
  //  @endif

  //  @if (session('error'))
  //   swal("Error", "{{ session('error') }}", "error");
  //  @endif
</script>

<script>
  document.addEventListener('DOMContentLoaded', (event) => {
    const toastSuccess = document.getElementById('toast-success');
    const toastDanger = document.getElementById('toast-danger');

    const handleToast = (toast) => {
        if (toast) {
            toast.classList.add('active');
            setTimeout(() => {
                toast.classList.add('fade-out');
                toast.addEventListener('animationend', () => {
                    toast.remove();
                });
                toast.classList.remove('active');
            }, 5000); // 5000 milliseconds = 5 seconds
        }
    };

      handleToast(toastSuccess);
      handleToast(toastDanger);
  });
</script>


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js
    "></script>
<script>
$(document).ready(function() {

    // Fungsi untuk mengambil data dari server
    function fetchData(page = 1) {
        $.ajax({
            url: `http://127.0.0.1:8000/telegram/getDataValidasi?page=${page}`,
            method: 'GET',
            success: function(response) {
                updateTable(response.data, page, response.per_page);
                updatePagination(response);
            },
            error: function() {
                console.error('Failed to fetch data.');
            }
        });
    }

    // Fungsi untuk memperbarui tabel dengan data baru
    function updateTable(data, currentPage, perPage) {
        const $tbody = $('#transaksiBody');
        $tbody.empty(); // Hapus baris yang ada sebelumnya
        if (data.length === 0) {
            $tbody.append(`
                
                 <tr>
                      <td class="px-6 py-4">&nbsp;</td>
                      <td class="px-6 py-4">&nbsp;</td>
                      <td class="px-6 py-4">&nbsp;</td>
                      <td class="px-6 py-4">&nbsp;</td>
                      <td class="px-6 py-4">&nbsp;</td>
                      <td class="px-6 py-4">&nbsp;</td>
                  </tr>
                   <tr>
                      <td class="px-6 py-4">&nbsp;</td>
                      <td class="px-6 py-4">&nbsp;</td>
                      <td class="px-6 py-4">&nbsp;</td>
                      <td class="px-6 py-4">&nbsp;</td>
                      <td class="px-6 py-4">&nbsp;</td>
                      <td class="px-6 py-4">&nbsp;</td>
                  </tr> 
                  <tr>
                    <td colspan="6" class="text-center py-4">Data Tidak Tersedia</td>
                </tr>
                  <tr>
                      <td class="px-6 py-4">&nbsp;</td>
                      <td class="px-6 py-4">&nbsp;</td>
                      <td class="px-6 py-4">&nbsp;</td>
                      <td class="px-6 py-4">&nbsp;</td>
                      <td class="px-6 py-4">&nbsp;</td>
                      <td class="px-6 py-4">&nbsp;</td>
                  </tr>
                   <tr>
                      <td class="px-6 py-4">&nbsp;</td>
                      <td class="px-6 py-4">&nbsp;</td>
                      <td class="px-6 py-4">&nbsp;</td>
                      <td class="px-6 py-4">&nbsp;</td>
                      <td class="px-6 py-4">&nbsp;</td>
                      <td class="px-6 py-4">&nbsp;</td>
                  </tr>
            `);
        } else {
        // Buat baris baru untuk data
          data.forEach((item,index) => {
              const no = (currentPage - 1) * perPage + index + 1;
              const name = item.name.length > 20 ? item.name.substring(0, 20) + '...' : item.name;
              const statusLabel = item.status === 1 
                  ? '<span class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Done</span>'
                  : '<span class="bg-yellow-100 text-yellow-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">On Going</span>';

              const actionButton = `
                <a href="/exportData/${item.id}" class="inline-flex items-center py-1.5 px-3 ms-2 text-sm font-medium text-white bg-green-700 rounded-lg border border-green-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Export</a>
                <a href="/deleteEmail/${item.id}" class="inline-flex items-center py-1.5 px-3 ms-2 text-sm font-medium text-white bg-red-700 rounded-lg border border-red-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete</a>
              `;

              $tbody.append(`
                  <tr>
                      <td class="px-6 py-4">${no}</td>
                      <td class="px-6 py-4">${item.id}</td>
                      <td class="px-6 py-4">${name}</td>
                      <td class="px-6 py-4">${item.count} Email</td>
                      <td class="px-6 py-4">${statusLabel}</td>
                      <td class="px-6 py-4">${actionButton}</td>
                  </tr>
              `);
          });

          // Tambahkan baris kosong jika data kurang dari 5
          for (let i = data.length; i < 5; i++) {
              $tbody.append(`
                  <tr>
                      <td class="px-6 py-4">&nbsp;</td>
                      <td class="px-6 py-4">&nbsp;</td>
                      <td class="px-6 py-4">&nbsp;</td>
                      <td class="px-6 py-4">&nbsp;</td>
                      <td class="px-6 py-4">&nbsp;</td>
                      <td class="px-6 py-4">&nbsp;</td>
                  </tr>
              `);
          }
        }
    }

    // Fungsi untuk memperbarui elemen pagination
    function updatePagination(pagination) {
        const $pagination = $('#pagination');
        let paginationHtml = '';

        pagination.links.forEach(link => {
            if (link.url) {
                paginationHtml += `
                    <a href="#" class="mx-1 px-3 py-1 border rounded ${link.active ? 'bg-blue-500 text-white' : 'bg-white text-blue-500 hover:bg-blue-100'}" data-page="${getPageNumber(link.url)}">
                        ${link.label}
                    </a>`;
            } else {
                paginationHtml += `<span class="mx-1 px-3 py-1 border rounded bg-gray-300 text-gray-500">${link.label}</span>`;
            }
        });

        $pagination.html(paginationHtml);
    }

    // Fungsi untuk mendapatkan nomor halaman dari URL
    function getPageNumber(url) {
        const urlParams = new URLSearchParams(new URL(url).search);
        return urlParams.get('page');
    }

    // Event handler untuk klik pada tautan pagination
    $('#pagination').on('click', 'a', function(event) {
        event.preventDefault();
        const page = $(this).data('page');
        fetchData(page);
    });

    //  // Event handler untuk klik pada tombol delete
    //  $('#transaksiBody').on('click', '.delete-button', function() {
    //     const id = $(this).data('id');
    //     if (confirm('Are you sure you want to delete this item?')) {
    //         $.ajax({
    //             url: `http://127.0.0.1:8000/telegram/deleteEmail/${id}`,
    //             method: 'DELETE',
    //             data: {
    //                 _token: '{{ csrf_token() }}'
    //             },
    //             success: function() {
    //                 fetchData();
    //                 handleToast(toastSuccess);
    //                 // handleToast(toastDanger);
    //             },
    //             error: function() {
    //                 console.error('Failed to delete data.');

    //             }
    //         });
    //     }
    // });

    // Inisialisasi data awal pada halaman pertama
    fetchData();

    // Polling setiap 5 detik untuk data terbaru
    setInterval(() => {
        const currentPage = $('#pagination .bg-blue-500').data('page') || 1;
        fetchData(currentPage);
    }, 5000);
});




</script>

<script>
  (function() {
    window.addEventListener('load', () => {
      const $clipboards = document.querySelectorAll('.js-clipboard-example');
      $clipboards.forEach((el) => {
        const isToggleTooltip = HSStaticMethods.getClassProperty(el, '--is-toggle-tooltip') === 'false' ? false : true;
        
        const clipboard = new ClipboardJS(el, {
          text: (trigger) => {
            const clipboardText = trigger.dataset.clipboardText;

            if (clipboardText) return clipboardText;

            const clipboardTarget = trigger.dataset.clipboardTarget;
            const $element = document.querySelector(clipboardTarget);

            if (
              $element.tagName === 'SELECT'
              || $element.tagName === 'INPUT'
              || $element.tagName === 'TEXTAREA'
            ) return $element.value
            else return $element.textContent;
          }
        });
        clipboard.on('success', () => {
          const $default = el.querySelector('.js-clipboard-default');
          const $success = el.querySelector('.js-clipboard-success');
          const $successText = el.querySelector('.js-clipboard-success-text');
          const successText = el.dataset.clipboardSuccessText || '';
          const tooltip = el.closest('.hs-tooltip');
          const $tooltip = HSTooltip.getInstance(tooltip, true);
          let oldSuccessText;

          if ($successText) {
            oldSuccessText = $successText.textContent
            $successText.textContent = successText
          }
          if ($default && $success) {
            $default.style.display = 'none'
            $success.style.display = 'block'
          }
          if (tooltip && isToggleTooltip) HSTooltip.show(tooltip);
          if (tooltip && !isToggleTooltip) $tooltip.element.popperInstance.update();

          setTimeout(function () {
            if ($successText && oldSuccessText) $successText.textContent = oldSuccessText;
            if (tooltip && isToggleTooltip) HSTooltip.hide(tooltip);
            if (tooltip && !isToggleTooltip) $tooltip.element.popperInstance.update();
            if ($default && $success) {
              $success.style.display = '';
              $default.style.display = '';
            }
          }, 800);
        });
      });
    })
  })()
</script>

<script type="text/javascript" src="{{ asset('js/auth.js') }}"></script>
{{-- @vite('resources/js/app.js') --}}

    </body>
</html>
