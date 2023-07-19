<template>
    <b-navbar toggleable="lg" type="dark" variant="primary">
        <b-container>
            <b-navbar-brand href="#">
                <div class="d-flex align-items-center">
                    <b-icon-bezier class="h2 mr-2 text-white"></b-icon-bezier>
                    <span class="h3 text-white"
                        >&nbsp;CakePHP API-Vue Demo</span
                    >
                </div>
            </b-navbar-brand>
            <b-navbar-nav>
                <router-link to="/people">People</router-link>
            </b-navbar-nav>
            <b-navbar-nav class="ml-auto">
                <b-nav-item>
                    <!-- TODO: repo link -->
                    <!-- TODO: course link -->
                    <!-- TODO: cakedc link -->
                </b-nav-item>
            </b-navbar-nav>
        </b-container>
    </b-navbar>
</template>

<script>
import RouterLink from "@vue/cli-plugin-router";

export default {
    name: "HeaderBar",
    components: {
        RouterLink,
    },
};
</script>
