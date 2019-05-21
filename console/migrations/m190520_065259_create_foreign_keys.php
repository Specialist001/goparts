<?php

use yii\db\Migration;

/**
 * Class m190520_065259_create_foreign_keys
 */
class m190520_065259_create_foreign_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addForeignKey('fk-blogs-category_id', '{{%blogs}}', 'category_id', '{{%categories}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-blogs-create_user_id', '{{%blogs}}', 'create_user_id', '{{%user}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-blogs-update_user_id', '{{%blogs}}', 'update_user_id', '{{%user}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-blog_translations-blog_id', '{{%blog_translations}}', 'blog_id', '{{%blogs}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-posts-blog_id', '{{%posts}}', 'blog_id', '{{%blogs}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-posts-category_id', '{{%posts}}', 'category_id', '{{%categories}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-posts-create_user_id', '{{%posts}}', 'create_user_id', '{{%user}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-posts-update_user_id', '{{%posts}}', 'update_user_id', '{{%user}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-post_translations-post_id', '{{%post_translations}}', 'post_id', '{{%posts}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-post_to_tags-post_id', '{{%post_to_tags}}', 'post_id', '{{%posts}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-post_to_tags-tag_id', '{{%post_to_tags}}', 'tag_id', '{{%tags}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-users_blog-user_id', '{{%users_blog}}', 'user_id', '{{%user}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-users_blog-blog_id', '{{%users_blog}}', 'blog_id', '{{%blogs}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-categories-parent_id', '{{%categories}}', 'parent_id', '{{%categories}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-category_translations-category_id', '{{%category_translations}}', 'category_id', '{{%categories}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-comments-parent_id', '{{%comments}}', 'parent_id', '{{%comments}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-comments-user_id', '{{%comments}}', 'user_id', '{{%user}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-feedbacks-user_id', '{{%feedbacks}}', 'user_id', '{{%user}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-feedbacks-category_id', '{{%feedbacks}}', 'category_id', '{{%categories}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-images-category_id', '{{%images}}', 'category_id', '{{%categories}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-images-parent_id', '{{%images}}', 'parent_id', '{{%images}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-images-user_id', '{{%images}}', 'user_id', '{{%user}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-galleries-user_id', '{{%galleries}}', 'user_id', '{{%user}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-galleries-preview_id', '{{%galleries}}', 'preview_id', '{{%images}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-galleries-category_id', '{{%galleries}}', 'category_id', '{{%categories}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-galleries_to_images-image_id', '{{%galleries_to_images}}', 'image_id', '{{%images}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-galleries_to_images-gallery_id', '{{%galleries_to_images}}', 'gallery_id', '{{%galleries}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-mail_templates-event_id', '{{%mail_templates}}', 'event_id', '{{%mail_events}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-menu_items-parent_id', '{{%menu_items}}', 'parent_id', '{{%menu_items}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-menu_items-menu_id', '{{%menu_items}}', 'menu_id', '{{%menus}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-news-category_id', '{{%news}}', 'category_id', '{{%categories}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-news-user_id', '{{%news}}', 'user_id', '{{%user}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-news_translations-news_id', '{{%news_translations}}', 'news_id', '{{%news}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-notify_settings-user_id', '{{%notify_settings}}', 'user_id', '{{%user}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-pages-parent_id', '{{%pages}}', 'parent_id', '{{%pages}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-pages-category_id', '{{%pages}}', 'category_id', '{{%categories}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-pages-user_id', '{{%pages}}', 'user_id', '{{%user}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-pages-change_user_id', '{{%pages}}', 'change_user_id', '{{%user}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-page_translations-page_id', '{{%page_translations}}', 'page_id', '{{%pages}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-query_images-query_id', '{{%query_images}}', 'query_id', '{{%queries}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-product_statistics-product_id', '{{%product_statistics}}', 'product_id', '{{%store_products}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-product_statistics-user_id', '{{%product_statistics}}', 'user_id', '{{%user}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-product_statistics-category_id', '{{%product_statistics}}', 'category_id', '{{%store_categories}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_attributes-group_id', '{{%store_attributes}}', 'group_id', '{{%store_attribute_groups}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_attribute_translations-attribute_id', '{{%store_attribute_translations}}', 'attribute_id', '{{%store_attributes}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_attribute_group_translations-attribute_group_id', '{{%store_attribute_group_translations}}', 'attribute_group_id', '{{%store_attribute_groups}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_attribute_options-attribute_id', '{{%store_attribute_options}}', 'attribute_id', '{{%store_attribute_groups}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_attribute_option_translations-attribute_option_id', '{{%store_attribute_option_translations}}', 'attribute_option_id', '{{%store_attribute_options}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_categories-parent_id', '{{%store_categories}}', 'parent_id', '{{%categories}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_category_translations-category_id', '{{%store_category_translations}}', 'category_id', '{{%categories}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_category_attributes-category_id', '{{%store_category_attributes}}', 'category_id', '{{%categories}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_category_attribute_values-store_category_id', '{{%store_category_attribute_values}}', 'store_category_id', '{{%store_categories}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-store_category_attribute_values-store_attribute_id', '{{%store_category_attribute_values}}', 'store_attribute_id', '{{%store_attributes}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-store_category_attribute_values-store_option_id', '{{%store_category_attribute_values}}', 'store_option_id', '{{%store_attribute_options}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_delivery_payments-delivery_id', '{{%store_delivery_payments}}', 'delivery_id', '{{%store_deliveries}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-store_delivery_payments-payment_id', '{{%store_delivery_payments}}', 'payment_id', '{{%store_payments}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_orders-user_id', '{{%store_orders}}', 'user_id', '{{%user}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-store_orders-delivery_id', '{{%store_orders}}', 'delivery_id', '{{%store_deliveries}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-store_orders-status_id', '{{%store_orders}}', 'status_id', '{{%store_order_status}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-store_orders-manager_id', '{{%store_orders}}', 'manager_id', '{{%user}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-store_orders-payment_method_id', '{{%store_orders}}', 'payment_method_id', '{{%store_payments}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_orders_to_coupon-order_id', '{{%store_orders_to_coupon}}', 'order_id', '{{%store_orders}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-store_orders_to_coupon-coupon_id', '{{%store_orders_to_coupon}}', 'coupon_id', '{{%store_coupons}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_order_products-order_id', '{{%store_order_products}}', 'order_id', '{{%store_orders}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-store_order_products-product_id', '{{%store_order_products}}', 'product_id', '{{%store_products}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_payments-product_id', '{{%store_payments}}', 'currency_id', '{{%currencies}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_products-type_id', '{{%store_products}}', 'type_id', '{{%store_types}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-store_products-producer_id', '{{%store_products}}', 'producer_id', '{{%store_producers}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-store_products-category_id', '{{%store_products}}', 'category_id', '{{%store_categories}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-store_products-type_car_id', '{{%store_products}}', 'type_car_id', '{{%store_type_of_cars}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-store_products-user_id', '{{%store_products}}', 'user_id', '{{%user}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_product_translations-product_id', '{{%store_product_translations}}', 'product_id', '{{%store_products}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_product_attributes-product_id', '{{%store_product_attributes}}', 'product_id', '{{%store_products}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-store_product_attributes-type_id', '{{%store_product_attributes}}', 'type_id', '{{%store_types}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_product_attribute_values-product_id', '{{%store_product_attribute_values}}', 'product_id', '{{%store_products}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-store_product_attribute_values-attribute_id', '{{%store_product_attribute_values}}', 'attribute_id', '{{%store_attributes}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-store_product_attribute_values-option_id', '{{%store_product_attribute_values}}', 'option_id', '{{%store_attribute_options}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_product_to_category-option_id', '{{%store_product_to_category}}', 'product_id', '{{%store_products}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-store_product_to_category-category_id', '{{%store_product_to_category}}', 'category_id', '{{%store_categories}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_product_commissions-product_id', '{{%store_product_commissions}}', 'product_id', '{{%store_products}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_product_images-product_id', '{{%store_product_images}}', 'product_id', '{{%store_products}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-store_product_images-group_id', '{{%store_product_images}}', 'group_id', '{{%store_product_image_groups}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_product_links-product_id', '{{%store_product_links}}', 'product_id', '{{%store_products}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-store_product_links-type_id', '{{%store_product_links}}', 'type_id', '{{%store_product_link_types}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-store_product_links-linked_product_id', '{{%store_product_links}}', 'linked_product_id', '{{%store_products}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_product_type_of_car_values-product_id', '{{%store_product_type_of_car_values}}', 'product_id', '{{%store_products}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-store_product_type_of_car_values-type_car_id', '{{%store_product_type_of_car_values}}', 'type_car_id', '{{%store_type_of_cars}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_product_variants-product_id', '{{%store_product_variants}}', 'product_id', '{{%store_products}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-store_product_variants-attribute_id', '{{%store_product_variants}}', 'attribute_id', '{{%store_attributes}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_product_videos-product_id', '{{%store_product_videos}}', 'product_id', '{{%store_products}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_product_to_cars-product_id', '{{%store_product_to_cars}}', 'product_id', '{{%store_products}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-store_product_to_cars-car_id', '{{%store_product_to_cars}}', 'car_id', '{{%cars}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_type_attributes-type_id', '{{%store_type_attributes}}', 'type_id', '{{%store_types}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-store_type_attributes-attribute_id', '{{%store_type_attributes}}', 'attribute_id', '{{%store_attributes}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_type_of_cars-parent_id', '{{%store_type_of_cars}}', 'parent_id', '{{%store_type_of_cars}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_type_of_car_translations-type_car_id', '{{%store_type_of_car_translations}}', 'type_car_id', '{{%store_type_of_cars}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-store_user_comissions-user_id', '{{%store_user_comissions}}', 'user_id', '{{%user}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-subscriptions-user_id', '{{%subscriptions}}', 'user_id', '{{%user}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('fk-blogs-category_id', '{{%blogs}}');
        $this->dropForeignKey('fk-blogs-create_user_id', '{{%blogs}}');
        $this->dropForeignKey('fk-blogs-update_user_id', '{{%blogs}}');

        $this->dropForeignKey('fk-blog_translations-blog_id', '{{%blog_translations}}');

        $this->dropForeignKey('fk-posts-blog_id', '{{%posts}}');
        $this->dropForeignKey('fk-posts-category_id', '{{%posts}}');
        $this->dropForeignKey('fk-posts-create_user_id', '{{%posts}}');
        $this->dropForeignKey('fk-posts-update_user_id', '{{%posts}}');

        $this->dropForeignKey('fk-post_translations-post_id', '{{%post_translations}}');

        $this->dropForeignKey('fk-post_to_tags-post_id', '{{%post_to_tags}}');
        $this->dropForeignKey('fk-post_to_tags-tag_id', '{{%post_to_tags}}');

        $this->dropForeignKey('fk-users_blog-user_id', '{{%users_blog}}');
        $this->dropForeignKey('fk-users_blog-blog_id', '{{%users_blog}}');

        $this->dropForeignKey('fk-categories-parent_id', '{{%categories}}');

        $this->dropForeignKey('fk-category_translations-parent_id', '{{%category_translations}}');

        $this->dropForeignKey('fk-comments-parent_id', '{{%comments}}');
        $this->dropForeignKey('fk-comments-user_id', '{{%comments}}');

        $this->dropForeignKey('fk-feedbacks-user_id', '{{%feedbacks}}');
        $this->dropForeignKey('fk-feedbacks-category_id', '{{%feedbacks}}');

        $this->dropForeignKey('fk-images-category_id', '{{%images}}');
        $this->dropForeignKey('fk-images-parent_id', '{{%images}}');
        $this->dropForeignKey('fk-images-user_id', '{{%images}}');

        $this->dropForeignKey('fk-galleries-user_id', '{{%galleries}}');
        $this->dropForeignKey('fk-galleries-preview_id', '{{%galleries}}');
        $this->dropForeignKey('fk-galleries-category_id', '{{%galleries}}');

        $this->dropForeignKey('fk-galleries_to_images-image_id', '{{%galleries_to_images}}');
        $this->dropForeignKey('fk-galleries_to_images-gallery_id', '{{%galleries_to_images}}');

        $this->dropForeignKey('fk-mail_templates-event_id', '{{%mail_templates}}');

        $this->dropForeignKey('fk-menu_items-parent_id', '{{%menu_items}}');
        $this->dropForeignKey('fk-menu_items-menu_id', '{{%menu_items}}');

        $this->dropForeignKey('fk-news-category_id', '{{%news}}');
        $this->dropForeignKey('fk-news-user_id', '{{%news}}');

        $this->dropForeignKey('fk-news_translations-news_id', '{{%news_translations}}');

        $this->dropForeignKey('fk-notify_settings-user_id', '{{%notify_settings}}');

        $this->dropForeignKey('fk-pages-parent_id', '{{%pages}}');
        $this->dropForeignKey('fk-pages-category_id', '{{%pages}}');
        $this->dropForeignKey('fk-pages-user_id', '{{%pages}}');
        $this->dropForeignKey('fk-pages-change_user_id', '{{%pages}}');

        $this->dropForeignKey('fk-page_translations-page_id', '{{%page_translations}}');

        $this->dropForeignKey('fk-query_images-query_id', '{{%query_images}}');

        $this->dropForeignKey('fk-product_statistics-product_id', '{{%product_statistics}}');
        $this->dropForeignKey('fk-product_statistics-user_id', '{{%product_statistics}}');
        $this->dropForeignKey('fk-product_statistics-category_id', '{{%product_statistics}}');

        $this->dropForeignKey('fk-store_attributes-group_id', '{{%store_attributes}}');

        $this->dropForeignKey('fk-store_attribute_translations-attribute_id', '{{%store_attribute_translations}}');

        $this->dropForeignKey('fk-store_attribute_group_translations-attribute_group_id', '{{%store_attribute_group_translations}}');

        $this->dropForeignKey('fk-store_attribute_options-attribute_id', '{{%store_attribute_options}}');

        $this->dropForeignKey('fk-store_attribute_option_translations-attribute_option_id', '{{%store_attribute_option_translations}}');

        $this->dropForeignKey('fk-store_categories-parent_id', '{{%store_categories}}');

        $this->dropForeignKey('fk-store_category_translations-category_id', '{{%store_category_translations}}');

        $this->dropForeignKey('fk-store_category_attributes-category_id', '{{%store_category_attributes}}');

        $this->dropForeignKey('fk-store_category_attribute_values-store_category_id', '{{%store_category_attribute_values}}');
        $this->dropForeignKey('fk-store_category_attribute_values-store_attribute_id', '{{%store_category_attribute_values}}');
        $this->dropForeignKey('fk-store_category_attribute_values-store_option_id', '{{%store_category_attribute_values}}');

        $this->dropForeignKey('fk-store_delivery_payments-delivery_id', '{{%store_delivery_payments}}');
        $this->dropForeignKey('fk-store_delivery_payments-payment_id', '{{%store_delivery_payments}}');

        $this->dropForeignKey('fk-store_orders-user_id', '{{%store_orders}}');
        $this->dropForeignKey('fk-store_orders-delivery_id', '{{%store_orders}}');
        $this->dropForeignKey('fk-store_orders-status_id', '{{%store_orders}}');
        $this->dropForeignKey('fk-store_orders-manager_id', '{{%store_orders}}');
        $this->dropForeignKey('fk-store_orders-payment_method_id', '{{%store_orders}}');

        $this->dropForeignKey('fk-store_orders_to_coupon-order_id', '{{%store_orders_to_coupon}}');
        $this->dropForeignKey('fk-store_orders_to_coupon-coupon_id', '{{%store_orders_to_coupon}}');

        $this->dropForeignKey('fk-store_order_products-order_id', '{{%store_order_products}}');
        $this->dropForeignKey('fk-store_order_products-product_id', '{{%store_order_products}}');

        $this->dropForeignKey('fk-store_payments-product_id', '{{%store_payments}}');

        $this->dropForeignKey('fk-store_products-type_id', '{{%store_products}}');
        $this->dropForeignKey('fk-store_products-producer_id', '{{%store_products}}');
        $this->dropForeignKey('fk-store_products-category_id', '{{%store_products}}');
        $this->dropForeignKey('fk-store_products-type_car_id', '{{%store_products}}');
        $this->dropForeignKey('fk-store_products-user_id', '{{%store_products}}');

        $this->dropForeignKey('fk-store_product_translations-product_id', '{{%store_product_translations}}');

        $this->dropForeignKey('fk-store_product_attributes-product_id', '{{%store_product_attributes}}');
        $this->dropForeignKey('fk-store_product_attributes-type_id', '{{%store_product_attributes}}');

        $this->dropForeignKey('fk-store_product_attribute_values-product_id', '{{%store_product_attribute_values}}');
        $this->dropForeignKey('fk-store_product_attribute_values-attribute_id', '{{%store_product_attribute_values}}');
        $this->dropForeignKey('fk-store_product_attribute_values-option_id', '{{%store_product_attribute_values}}');

        $this->dropForeignKey('fk-store_product_to_category-option_id', '{{%store_product_to_category}}');
        $this->dropForeignKey('fk-store_product_to_category-category_id', '{{%store_product_to_category}}');

        $this->dropForeignKey('fk-store_product_commissions-product_id', '{{%store_product_commissions}}');

        $this->dropForeignKey('fk-store_product_images-product_id', '{{%store_product_images}}');
        $this->dropForeignKey('fk-store_product_images-group_id', '{{%store_product_images}}');

        $this->dropForeignKey('fk-store_product_links-product_id', '{{%store_product_links}}');
        $this->dropForeignKey('fk-store_product_links-type_id', '{{%store_product_links}}');
        $this->dropForeignKey('fk-store_product_links-linked_product_id', '{{%store_product_links}}');

        $this->dropForeignKey('fk-store_product_type_of_car_values-product_id', '{{%store_product_type_of_car_values}}');
        $this->dropForeignKey('fk-store_product_type_of_car_values-type_car_id', '{{%store_product_type_of_car_values}}');

        $this->dropForeignKey('fk-store_product_variants-product_id', '{{%store_product_variants}}');
        $this->dropForeignKey('fk-store_product_variants-attribute_id', '{{%store_product_variants}}');

        $this->dropForeignKey('fk-store_product_videos-product_id', '{{%store_product_videos}}');

        $this->dropForeignKey('fk-store_product_to_cars-product_id', '{{%store_product_to_cars}}');
        $this->dropForeignKey('fk-store_product_to_cars-car_id', '{{%store_product_to_cars}}');

        $this->dropForeignKey('fk-store_type_attributes-type_id', '{{%store_type_attributes}}');
        $this->dropForeignKey('fk-store_type_attributes-attribute_id', '{{%store_type_attributes}}');

        $this->dropForeignKey('fk-store_type_of_cars-parent_id', '{{%store_type_of_cars}}');

        $this->dropForeignKey('fk-store_type_of_car_translations-type_car_id', '{{%store_type_of_car_translations}}');

        $this->dropForeignKey('fk-store_user_comissions-user_id', '{{%store_type_of_car_translations}}');

        $this->dropForeignKey('fk-subscriptions-user_id', '{{%subscriptions}}');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190520_065259_create_foreign_keys cannot be reverted.\n";

        return false;
    }
    */
}
