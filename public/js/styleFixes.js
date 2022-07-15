document.addEventListener("click", function () {
    setTimeout(function () {
        // Bulk actions opened select
        Array.from(document.getElementsByClassName('bg-white rounded-md shadow-xs dark:bg-gray-700 dark:text-white'))
            .forEach((value) => {
                value.classList.remove('bg-white');
                value.classList.add('bg-gray-100');
                value.classList.add('text-black');
            })

        // bulk actions button
        Array.from(document.getElementsByClassName('inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600'))
            .forEach((value) => {
                value.classList.add('bg-gray-100');
            })
    }, 200);
});

window.onload = function () {
    // Bulk actions button
    Array.from(document.getElementsByClassName('inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600'))
        .forEach((value) => {
            value.classList.add('bg-gray-100');
        })

    // Button select ammount of results
    Array.from(document.getElementsByClassName('block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white dark:border-gray-600'))
        .forEach((value) => {
            value.classList.add('text-black');
        })

    // Labels of info for table results
    Array.from(document.getElementsByClassName('total-pagination-results text-sm text-gray-700 leading-5 dark:text-white'))
        .forEach((value) => {
            value.classList.add('text-white');
        })
};


