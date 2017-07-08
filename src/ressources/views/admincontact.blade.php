<h4>Contacts</h4>
<ng-form name="frm_profile_contacts" ng-repeat="contact in data" ng-if="!contact.deleted">
	<div layout="row">
		<md-input-container>
			<md-button ng-click="contact.coord=$root.selectedText" aria-label="Assign" class="md-icon-button"><md-icon md-font-icon="fa fa-long-arrow-right"></md-icon></md-button>
		</md-input-container>
		<md-input-container>
			<label>Type</label>
			<md-select name="immobilier_owner_contact_contact_type" ng-model="contact.contact_type" aria-label="Type">
				<md-option value="email">email</md-option>
				<md-option value="phone">phone</md-option>
				<md-option value="chat">chat</md-option>
			</md-select>
		</md-input-container>
		<md-input-container>
			<label>Heure</label>
			<md-select name="immobilier_owner_contact_type" ng-model="contact.type" aria-label="Heure">
				<md-option value="bureau">bureau</md-option>
				<md-option value="domicile">domicile</md-option>
				<md-option value="portable">portable</md-option>
				<md-option value="vacance">vacance</md-option>
			</md-select>
		</md-input-container>
		<md-input-container>
			<label>Coordonnées</label>
			<input type="text" name="immobilier_owner_contact_coord" ng-model="contact.coord" required>
			<div ng-messages="frm_profile_contacts.immobilier_owner_contact_coord.$error">
		 		<div ng-message="required">Ce champ est absolument requis</div>
		 	</div>
		</md-input-container>
		<md-input-container>
			<md-button class="md-icon-button" ng-click="$root.ask('contact')" aria-label="Assign"><md-icon md-font-icon="fa fa-send"></md-icon></md-button>
			<md-button class="md-icon-button" ng-if="(data|filter:{deleted:'!true'}).length>1" ng-click="contact.deleted=true" aria-label="remove"><md-icon md-font-icon="fa fa-minus-circle"></md-icon></md-button>
		</md-input-container>
	</div>
</ng-form>
<md-button ng-click="data.push({type : 'bureau',contact_type : 'phone'})" aria-label="add" class="md-raised md-accent"><md-icon md-font-icon="fa fa-plus-circle"></md-icon> contact</md-button>
