<template>
    <div class="bg-white">
        <div
            class="mx-auto max-w-2xl py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8"
        >
            <div class="text-center w-full">
                <h1 class="block mb-2 text-gray-900 dark:text-white">
                    Search Hotel
                </h1>
                <auto-complete-component
                    :data="cities"
                    v-model.trim="cityID"
                    @chosen="search"
                    placeholder="Adelaide"
                    inputClass="w-full mt-5 pa-5 border-none focus:ring-0 m-auto text-center"
                />
            </div>
            <div class="text-center mt-10" v-if="loading">
                <div role="status">
                    <svg
                        class="inline mr-2 w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                        viewBox="0 0 100 101"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor"
                        />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill"
                        />
                    </svg>
                </div>
            </div>
            <div
                v-else
                class="mt-10 w-100 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            >
                <a
                    v-for="item in lists['popular']"
                    href="#"
                    aria-current="true"
                    class="block py-2 px-4 w-full text-white bg-blue-700 rounded-t-lg border-b border-gray-200 cursor-pointer dark:bg-gray-800 dark:border-gray-600"
                >
                    The Most <b>popular</b> hotel in
                    <b>{{ item?.PlaceName }}</b> is <b>{{ item?.HotelName }}</b
                    >. Book now for <b>{{ item?.MinRate }}</b>
                </a>
                <a
                    v-for="item in lists['cheap']"
                    href="#"
                    class="block py-2 px-4 w-full border-b border-gray-200 cursor-pointer hover:bg-gray-100 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white"
                >
                    The <b>cheapest</b> hotel in <b>{{ item?.PlaceName }}</b> is
                    <b>{{ item?.HotelName }}</b> . Book now for
                    <b>{{ item?.MinRate }}</b>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
            jsonData: {
                q: "",
            },
            cityID: 0,
            lists: [],
            cities: [],
        };
    },
    mounted() {
        console.log("Component mounted.");
        this.getCities();
    },
    methods: {
        async search(item) {
            try {
                if (item?.value.length <= 1) return;
                this.loading = true;
                this.lists = [];
                const res = await fetch(`/api/search/hotel?q=${item?.value}`);
                this.loading = false;
                if (!res.ok) {
                    const message = `An error has occured: ${res.status}`;
                    throw new Error(message);
                }
                const data = await res.json();
                this.lists = data.data;
            } catch (err) {
                //
            }
        },
        async getCities() {
            try {
                this.cities = [];
                const res = await fetch(`/api/cities?name=`);
                this.loading = false;
                if (!res.ok) {
                    const message = `An error has occured: ${res.status}`;
                    throw new Error(message);
                }
                const data = await res.json();
                this.cities = data.data;
            } catch (err) {
                //
            }
        },
    },
};
</script>
