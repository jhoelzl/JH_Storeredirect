<?php

class JH_Storeredirect_Model_Observer {
    
    public function redirectLocale($observer) {
         
         if (Mage::getStoreConfig('storeredirect/general/enable') == true)  {
         
         $currentUrl = Mage::helper('core/url')->getCurrentUrl();

          if (!(Mage::app()->getStore()->isAdmin()) and strpos($currentUrl, '/page/') == false and strpos($currentUrl, 'store=') == false) {

	          // Get requested URL Path	          
			  $url = Mage::getSingleton('core/url')->parseUrl($currentUrl);
			  $path = trim(substr($url->getPath(),1));	          
	          
	          if ($path != false and $path != "catalogsearch/result/") {
	          
				// Get current Website ID
		          $current_website_id = Mage::app()->getStore()->getWebsiteId();
		          $current_website_domain = Mage::getBaseUrl();
		          
		          // Get all StoreViews for current Website
		          $current_website_store_list = array();
		          $collection = Mage::getModel('core/store')->getCollection()->addFieldToFilter('website_id', $current_website_id);
				  foreach ($collection as $store) {			
					  $current_website_store_list[] = $store->getStoreId();	   
				  }
	
		          // Get current Store View ID
		          $current_store_id = Mage::app()->getStore()->getStoreId();
		          
		          // Find matching store view(s) for this url path
		          $resource = Mage::getSingleton('core/resource');
		          $readConnection = $resource->getConnection('core_read');
		          
		          $query = 'SELECT cu.store_id FROM ' . $resource->getTableName('core/url_rewrite')  . " cu left outer join ". $resource->getTableName('core/store'). " cs on cu.store_id = cs.store_id where cu.request_path  = '". $path ."' and cu.store_id IN (".implode(",", $current_website_store_list) .") order by cs.sort_order";
		          $redirect_store_ids = $readConnection->fetchCol($query);
		          
		          if(count($redirect_store_ids) > 0) {
			        
					// If current Store is in Store List for this url then no redirection	
					if (!in_array($current_store_id, $redirect_store_ids)) {	         		      
						
						// Redirect to best matching store view: Choice depends on sort_order in table core_store		
						$store = Mage::getModel('core/store')->load($redirect_store_ids[0]);					 	
						$name = $store->getCode();
		
						$url = $current_website_domain .$path . '?___store='.$name; 
						header( 'Location:' . $url);die;
					   
					 }  
	             } 
		      }
		  }      
    }
    }
}
