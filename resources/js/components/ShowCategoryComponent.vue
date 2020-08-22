<template>
    <div>
        <h2>Hello from Vue.js</h2>
        <div v-for="(category, key) in this.categories" :key="key">
            <h4>{{ category.categoryname }}</h4>
            <ul>
                <li v-for="(subcat, key) in category.subcategories" :key="key">
                    {{ subcat.subcategoryname }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    props: ["categories"],
    mounted() {
        console.log("Component mounted.");
    }
};
</script>
