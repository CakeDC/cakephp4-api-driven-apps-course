<template>
    <div>
        <b-row>
            <b-alert v-model="showSuccessAlert" variant="success" dismissible>
                {{ alertMessage }}
            </b-alert>
        </b-row>
        <b-row class="mt-3">
            <b-card>
                <b-row align-h="between">
                    <b-col cols="6">
                        <h3>{{ tableHeader }}</h3>
                    </b-col>
                    <b-col cols="2">
                        <b-row>
                            <b-col>
                                <b-button
                                    variant="primary"
                                    id="show-btn"
                                    @click="showCreateModal"
                                >
                                    <b-icon-plus
                                        class="text-white"
                                    ></b-icon-plus>
                                    <span class="h6 text-white"
                                        >New Person</span
                                    >
                                </b-button>
                            </b-col>
                        </b-row>
                    </b-col>
                </b-row>
                <b-row class="mt-3">
                    <b-table
                        striped
                        hover
                        :items="items"
                        :fields="fields"
                        class="text-center"
                    >
                        <template #cell(contact_name)="data">
                            {{
                                `${data.item.contact_firstname} ${data.item.contact_lastname}`
                            }}
                        </template>
                        <template #cell(person_status)="data">
                            <b-icon-bookmark-check-fill
                                variant="success"
                                v-if="data.item.person_status === 'active'"
                            ></b-icon-bookmark-check-fill>
                            <b-icon-bookmark-x-fill
                                variant="danger"
                                v-else
                            ></b-icon-bookmark-x-fill>
                        </template>
                        <template #cell(actions)="data">
                            <b-row>
                                <b-col cols="7">
                                    <b-icon-pencil-square
                                        class="action-item"
                                        variant="primary"
                                        @click="getRowData(data.item.id)"
                                    ></b-icon-pencil-square>
                                </b-col>
                                <b-col cols="1">
                                    <b-icon-trash-fill
                                        class="action-item"
                                        variant="danger"
                                        @click="showDeleteModal(data.item.id)"
                                    ></b-icon-trash-fill>
                                </b-col>
                            </b-row>
                        </template>
                    </b-table>
                </b-row>
            </b-card>
        </b-row>

        <!-- Modal for adding new people -->
        <b-modal
            ref="create-person-modal"
            size="xl"
            hide-footer
            title="New Person"
        >
            <create-person-form
                @closeCreateModal="closeCreateModal"
                @reloadDataTable="getPersonData"
                @showSuccessAlert="showAlertCreate"
            ></create-person-form>
        </b-modal>

        <!-- Modal for updating people -->
        <b-modal
            ref="edit-person-modal"
            size="xl"
            hide-footer
            title="Edit Person"
        >
            <edit-person-form
                @closeEditModal="closeEditModal"
                @reloadDataTable="getPersonData"
                @showSuccessAlert="showAlertUpdate"
                :personId="personId"
            ></edit-person-form>
        </b-modal>

        <!-- Delete Person Modal -->
        <b-modal
            ref="delete-person-modal"
            size="md"
            hide-footer
            title="Confirm Deletion"
        >
            <delete-person-modal
                @closeDeleteModal="closeDeleteModal"
                @reloadDataTable="getPersonData"
                @showDeleteAlert="showDeleteSuccessModal"
                :personId="personId"
            ></delete-person-modal>
        </b-modal>
    </div>
</template>

<script>
import axios from "axios";
import CreatePersonForm from "@/components/person/CreatePersonForm.vue";
import EditPersonForm from "@/components/person/EditPersonForm.vue";
import DeletePersonModal from "@/components/person/DeletePersonModal.vue";

export default {
    name: "PeopleView",
    components: {
        CreatePersonForm,
        EditPersonForm,
        DeletePersonModal,
    },
    data() {
        return {
            // Note 'isActive' is left out and will not appear in the rendered table

            fields: [
                {
                    key: "company_name",
                    label: "Company Name",
                    sortable: false,
                },
                {
                    key: "contact_name",
                    label: "Contact Name",
                    sortable: false,
                },
                {
                    key: "contact_email",
                    label: "Contact E-Mail",
                    sortable: false,
                },
                {
                    key: "person_status",
                    label: "Person Status",
                    sortable: false,
                },
                "actions",
            ],
            items: [],
            numberOfPeople: 0,
            activePeople: 0,
            activePeopleData: [],
            personId: 0,
            companySearchTerm: "",
            tableHeader: "",
            showSuccessAlert: false,
            alertMessage: "",
        };
    },
    mounted() {
        this.getPersonData();
    },
    methods: {
        showCreateModal() {
            this.$refs["create-person-modal"].show();
        },
        closeCreateModal() {
            this.$refs["create-person-modal"].hide();
        },
        getPersonData() {
            axios
                .get("http://localhost:8080/api/people/")
                .then((response) => {
                    this.tableHeader = "Total Person";
                    this.items = response.data;
                    this.numberOfPeople = response.data.length;
                    this.activePeopleData = response.data.filter(
                        (item) => item.person_status === "active"
                    );
                    this.activePeople = this.activePeopleData.length;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getRowData(id) {
            this.$refs["edit-person-modal"].show();
            this.personId = id;
        },
        closeEditModal() {
            this.$refs["edit-person-modal"].hide();
        },
        setFilterTotalIsActive() {
            this.tableHeader = "Total People";
            this.getPersonData();
        },
        setFilterActiveIsActive() {
            this.tableHeader = "Active People";
            this.items = this.activePeopleData;
        },
        showAlertCreate() {
            this.showSuccessAlert = true;
            this.alertMessage = "Person was created successfully!";
        },
        showAlertUpdate() {
            this.showSuccessAlert = true;
            this.alertMessage = "Person was updated successfully";
        },
        showDeleteModal(id) {
            this.$refs["delete-person-modal"].show();
            this.personId = id;
        },
        closeDeleteModal() {
            this.$refs["delete-person-modal"].hide();
        },
        showDeleteSuccessModal() {
            this.showSuccessAlert = true;
            this.alertMessage = "Person was deleted successfully!";
        },
    },
};
</script>

<style>
.action-item:hover {
    cursor: pointer;
}
</style>
