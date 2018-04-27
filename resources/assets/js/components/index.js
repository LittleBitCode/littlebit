import Vue from 'vue'
import Icon from './Icon'
import EmailInput from './form/EmailInput'
import MobileInput from './form/MobileInput'
import ProgressBar from './ProgressBar'
import ValidationInput from './form/ValidationInput'
import PasswordInput from './form/PasswordInput'
import SubmitButton from './form/SubmitButton'
import TextInput from './form/TextInput'
import BMapSearch from './form/BMapSearch'
import { HasError, AlertError, AlertSuccess } from 'vform'
import Input from './form/IqxInput'
import Button from './form/IqxButton'
import ListContainer from './form/ListContainer'
import FileUploader from './form/FileUploader'
import UploadButton from './form/UploadButton'

Vue.component(Icon.name, Icon)
Vue.component(EmailInput.name, EmailInput)
Vue.component(MobileInput.name, MobileInput)
Vue.component(ProgressBar.name, ProgressBar)
Vue.component(ValidationInput.name, ValidationInput)
Vue.component(PasswordInput.name, PasswordInput)
Vue.component(SubmitButton.name, SubmitButton)
Vue.component(TextInput.name, TextInput)
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertSuccess.name, AlertSuccess)
Vue.component(BMapSearch.name, BMapSearch)
Vue.component(Input.name, Input)
Vue.component(Button.name, Button)
Vue.component(ListContainer.name, ListContainer)
Vue.component(FileUploader.name, FileUploader)
Vue.component(UploadButton.name, UploadButton)
