<template>
    <b-form class="mt-3">
        <b-row>
            <b-row>
                <h4 class="text-secondary">Contact Details</h4>
            </b-row>
            <b-col cols="6">
                <b-form-group
                    id="first-name"
                    label="First Name"
                    label-for="first-name"
                >
                    <b-form-input
                        id="first-name"
                        type="text"
                        placeholder="First Name"
                        v-model="person.contact_firstname"
                    ></b-form-input>
                </b-form-group>
            </b-col>
            <b-col cols="6">
                <b-form-group
                    id="last-name"
                    label="Last Name"
                    label-for="last-name"
                >
                    <b-form-input
                        id="last-name"
                        type="text"
                        placeholder="Last Name"
                        v-model="person.contact_lastname"
                    ></b-form-input>
                </b-form-group>
            </b-col>
        </b-row>
        <b-row class="mt-3">
            <b-col cols="6">
                <b-form-group id="email" label="E-Mail" label-for="email">
                    <b-form-input
                        id="email"
                        type="email"
                        placeholder="example@crm.com"
                        v-model="person.contact_email"
                    ></b-form-input>
                </b-form-group>
            </b-col>
        </b-row>
        <b-row class="mt-5">
            <h4 class="text-secondary">Company Details</h4>
        </b-row>
        <b-row>
            <b-col cols="4">
                <b-form-group
                    id="company_name"
                    label="Company Name"
                    label-for="company_name"
                >
                    <b-form-input
                        id="company_name"
                        type="text"
                        placeholder="XYZ Industries"
                        v-model="person.company_name"
                    ></b-form-input>
                </b-form-group>
            </b-col>
        </b-row>
        <b-row>
            <b-col cols="4">
                <b-form-group
                    id="acquired_on"
                    label="Acquired On"
                    label-for="acquired_on"
                >
                    <b-form-input
                        id="acquired_on"
                        type="date"
                        v-model="person.acquired_on"
                    ></b-form-input>
                </b-form-group>
            </b-col>
        </b-row>
        <b-row class="mt-2">
            <b-form-checkbox
                id="person_status"
                v-model="person.person_status"
                name="person-status"
                value="active"
                unchecked-value="inactive"
            >
                Person is active
            </b-form-checkbox>
        </b-row>
        <b-row class="mt-4">
            <b-col cols="3">
                <b-button variant="primary" class="px-5" @click="updatePerson"
                    >Update Person</b-button
                >
            </b-col>
            <b-col>
                <b-button variant="warning" @click="triggerClose"
                    >Close</b-button
                >
            </b-col>
        </b-row>
    </b-form>
</template>

<script>
import axios from "axios";

export default {
    name: "EditPersonForm",
    props: {
        personId: Number,
    },
    data() {
        return {
            person: {},
        };
    },
    mounted() {
        this.getCusomterByID();
    },
    methods: {
        triggerClose() {
            this.$emit("closeEditModal");
        },
        getCusomterByID() {
            axios
                .get(`http://localhost:8080/api/people/${this.personId}`)
                .then((response) => {
                    this.person = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        updatePerson() {
            axios
                .put(
                    `http://localhost:8080/api/people/${this.personId}`,
                    this.person
                )
                .then((response) => {
                    console.log(response.data);
                    this.$emit("closeEditModal");
                    this.$emit("reloadDataTable");
                    this.$emit("showSuccessAlert");
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
