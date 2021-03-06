<template>
    <div class="max-w-lg">
        <div class="flex justify-center h-16 items-center px-2 text-2xl font-bold">
            <nuxt-link to>
                <img
                    src="@/assets/images/webidacta-logo.svg"
                    class="h-12 w-12"
                    alt="Logo Webidacta"
                />
            </nuxt-link>
        </div>
        <h2 class="text-center text-4xl font-bold mb-4">Inscription</h2>
        <div class="mb-8 text-center">
            Déjà inscrit ?
            <nuxt-link
                to="login"
                class="font-medium text-purple-600 hover:text-purple-500 focus:outline-none focus:underline transition ease-in-out duration-150"
            >Connectez-vous</nuxt-link>
        </div>
        <div class="sm:px-12 px-8 py-8 bg-white shadow-md rounded-lg w-auto">
            <form class="space-y-6" @submit.prevent="register">
                <div class="flex space-x-4">
                    <label class="block w-1/2">
                        <span class="text-cool-gray-700 font-medium">Prénom</span>
                        <input
                            v-model="userData.firstname"
                            autocomplete="given-name"
                            type="text"
                            :class="[
                                formErrors.firstname
                                    ? 'border-red-300 shadow-outline-red'
                                    : ''
                            ]"
                            class="form-input mt-1 block w-full focus:shadow-outline-purple focus:border-purple-300 transition duration-150 ease-in-out"
                        />
                        <div
                            v-if="formErrors.firstname"
                            class="text-red-600 text-sm mt-1"
                        >{{ formErrors.firstname[0] }}</div>
                    </label>
                    <label class="block w-1/2">
                        <span class="text-cool-gray-700 font-medium">Nom</span>
                        <input
                            v-model="userData.lastname"
                            autocomplete="family-name"
                            type="text"
                            :class="[
                                formErrors.lastname
                                    ? 'border-red-300 shadow-outline-red'
                                    : ''
                            ]"
                            class="form-input mt-1 block w-full focus:shadow-outline-purple focus:border-purple-300 transition duration-150 ease-in-out"
                        />
                        <div
                            v-if="formErrors.lastname"
                            class="text-red-600 text-sm mt-1"
                        >{{ formErrors.lastname[0] }}</div>
                    </label>
                </div>
                <label class="block">
                    <span class="text-cool-gray-700 font-medium">Adresse email</span>
                    <input
                        v-model="userData.email"
                        autocomplete="email"
                        type="email"
                        :class="[
                            formErrors.email
                                ? 'border-red-300 shadow-outline-red'
                                : ''
                        ]"
                        class="form-input mt-1 block w-full focus:shadow-outline-purple focus:border-purple-300 transition duration-150 ease-in-out"
                    />
                    <div
                        v-if="formErrors.email"
                        class="text-red-600 text-sm mt-1"
                    >{{ formErrors.email[0] }}</div>
                </label>
                <label class="block">
                    <span class="text-cool-gray-700 font-medium">Mot de passe</span>
                    <input
                        v-model="userData.password"
                        autocomplete="new-password"
                        type="password"
                        :class="[
                            formErrors.password
                                ? 'border-red-300 shadow-outline-red'
                                : ''
                        ]"
                        class="form-input mt-1 block w-full focus:shadow-outline-purple focus:border-purple-300 transition duration-150 ease-in-out"
                    />
                    <div
                        v-if="formErrors.password"
                        class="text-red-600 text-sm mt-1"
                    >{{ formErrors.password[0] }}</div>
                </label>
                <label class="block">
                    <span class="text-cool-gray-700 font-medium">Confirmation du mot de passe</span>
                    <input
                        v-model="passwordConfirmation"
                        autocomplete="off"
                        type="password"
                        :class="[
                            formErrors.passwordConfirmation
                                ? 'border-red-300 shadow-outline-red'
                                : ''
                        ]"
                        class="form-input mt-1 block w-full focus:shadow-outline-purple focus:border-purple-300 transition duration-150 ease-in-out"
                    />
                    <div
                        v-if="formErrors.passwordConfirmation"
                        class="text-red-600 text-sm mt-1"
                    >{{ formErrors.passwordConfirmation[0] }}</div>
                </label>
                <div></div>
                <button
                    type="submit"
                    class="flex w-full items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-purple-600 hover:bg-purple-500 focus:outline-none focus:shadow-outline-purple focus:border-purple-700 active:bg-purple-700 transition duration-150 ease-in-out"
                >S'inscrire</button>
            </form>
        </div>
    </div>
</template>

<script>
import UserService from '@/services/UserService.js'

export default {
	data() {
		return {
			formErrors: {},
			passwordConfirmationErrorMessage:
				'Les mots de passe doivent être identiques',
			passwordConfirmation: '',

			userData: {
				firstname: '',
				lastname: '',
				email: '',
				password: ''
			}
		}
	},
	methods: {
		async register() {
			try {
				await UserService.postUser(this.userData)
				this.$router.push('/home')
			} catch (error) {
				this.formErrors = {}
				this.createValidationMessagesObject(
					error.response.data.violations
				)
				this.checkPasswords()
			}
		},
		createValidationMessagesObject(object) {
			for (const index in object) {
				if (this.formErrors[object[index].propertyPath]) {
					this.formErrors[object[index].propertyPath].unshift(
						object[index].message
					)
				} else {
					this.formErrors[object[index].propertyPath] = []
					this.formErrors[object[index].propertyPath].unshift(
						object[index].message
					)
				}
			}
		},
		checkPasswords() {
			if (this.userData.password !== this.passwordConfirmation) {
				this.formErrors.passwordConfirmation = [
					this.passwordConfirmationErrorMessage
				]
			}
		}
	}
}
</script>

<style lang="scss" scoped></style>
