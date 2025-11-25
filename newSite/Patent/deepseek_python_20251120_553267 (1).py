class FSBOTransactionSystem:
    def process_flat_fee_payment(self, plan_type, property_details):
        # Calculate service package
        service_package = self.define_service_package(plan_type)
        
        # Process payment through integrated gateway
        payment_result = self.payment_gateway.charge(service_package.price)
        
        # Automatically activate services upon payment
        if payment_result.success:
            self.activate_services(service_package, property_details)
            self.update_mls_listing(property_details)
            self.initiate_marketing_campaign(property_details)
        
        return payment_result