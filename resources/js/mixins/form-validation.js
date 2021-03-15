export default {
    methods: {
        getRules() {
            return {
                "required": {
                    "validator": (value) => {
                        if (value == "") {
                            return false;
                        }

                        if (value == undefined) {
                            return false;
                        }

                        if (value == null) {
                            return false;
                        }

                        return true;
                    },
                    "getErrorMessage": (value, fieldViewName, params) => {
                        return `${fieldViewName} harus diisi`;
                    }
                },
                "minimum": {
                    "validator": (value, params) => {
                        const parsedValue = parseFloat(value);
                        const parsedMinimumValue = parseFloat(params['minimumValue']);

                        if (parsedValue < parsedMinimumValue) {
                            return false;
                        }

                        return true;
                    },
                    "getErrorMessage": (value, fieldViewName, params) => {
                        return `${fieldViewName} minimum adalah ${params['minimumValue']}`;
                    }
                }
            };
        },
        validateField(form, field) {
            
            const rules = this.getRules();

            const fieldRules = this.forms[form]['rules'][field];
            const fieldViewName = this.forms[form]['fieldViewName'][field];
            const value = this.forms[form]['data'][field];

            for (const fieldRule of fieldRules) {
                const rule = rules[fieldRule["name"]];
                const validationParams = fieldRule['params'];

                const validator = rule["validator"];
                const isValid = validator(value, validationParams);

                if (!isValid) {
                    const getErrorMessage = rule['getErrorMessage'];
                    const errorMessage = getErrorMessage(value, fieldViewName, validationParams);
                    this.setFieldErrorMessage(form, field, errorMessage);
                    this.setFieldValidStatus(form, field, false);
                    break;
                } else {
                    this.setFieldErrorMessage(form, field, "");
                    this.setFieldValidStatus(form, field, true);
                }
            }
        },
        validateForm(form) {

            const rules = this.getRules();

            for (const field in this.forms[form]['data']) {
                
                this.setFieldPristineStatus(form, field, false);

                const value = this.forms[form]['data'][field];
                const fieldRules = this.forms[form]['rules'][field];
                const fieldViewName = this.forms[form]['fieldViewName'][field];

                for (const fieldRule of fieldRules) {
                    const rule = rules[fieldRule["name"]];
                    const validationParams = fieldRule['params'];
                    const validator = rule["validator"];
                    const isValid = validator(value, validationParams);
                    
                    if (!isValid) {
                        const getErrorMessage = rule['getErrorMessage'];
                        const errorMessage = getErrorMessage(value, fieldViewName, validationParams);
                        this.setFieldErrorMessage(form, field, errorMessage);
                        this.setFieldValidStatus(form, field, false);
                    } else {
                        this.setFieldErrorMessage(form, field, "");
                        this.setFieldValidStatus(form, field, true);
                    }
                }
            } 
        },
        isFormValid(form) {
            return false;
        },
        setFieldErrorMessage(form, field, message) {
            this.forms[form]['errors'][field] = message;
        },
        setFieldValidStatus(form, field, value) {
            this.forms[form]['fieldStatuses'][field]['valid'] = value;
        },
        isFieldValid(form, field) {
            return this.forms[form]['fieldStatuses'][field]['valid'];
        },
        getFieldErrorMessage(form, field) {
            return this.forms[form]['errors'][field];
        },
        canErrorFieldBeShown(form, field) {
            const fieldStatus = this.forms[form]['fieldStatuses'][field];
            return !fieldStatus['pristine'] && !fieldStatus['valid'];
        },
        setFieldPristineStatus(form, field, value) {
            this.forms[form]['fieldStatuses'][field]['pristine'] = value;
        },
        onFieldKeyup(form, field) {
            this.setFieldPristineStatus(form, field, false);
            this.validateField(form, field);
        },
        resetForm(form) {
            for (const field in this.forms[form]['data']) {
                this.forms[form]['data'][field] = this.forms[form]['defaultValues'][field];
                this.setFieldPristineStatus(form, field, true);
                this.setFieldValidStatus(form, field, false);
            }
        },
        getFormFieldValue(form, field) {
            return this.forms[form]['data'][field];
        },
        isFormValid(form) {
            let isFormValid = true;
            for (const field in this.forms[form]['data']) {
                const isFieldValid = this.forms[form]['fieldStatuses'][field]['valid'];
                if (!isFieldValid) {
                    isFormValid = false;
                    break;
                }
            }
            
            return isFormValid;
        }
    }
}