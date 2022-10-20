<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_ajax_Api{

    protected $request = [];

    //calling the method dynamically
	public function action($request){
        if(isset($request['method']) && method_exists($this, $request['method'])){
            $this->request = $request;
            return $this->{$request['method']}();
        }
    }
    
   
     
    
    public function page_list(){
        $query_args = [
            'post_type'         => 'page',
            'post_status'       => 'publish',
            'posts_per_page'    => 15,
        ];

        if(isset($this->request['ids'])){
            $ids = explode(',', $this->request['ids']);
            $query_args['post__in'] = $ids;

            if($this->request['ids'] == ''){
                return ['results' => []];
            }
        }
        if(isset($this->request['s'])){
            $query_args['s'] = $this->request['s'];
        }

        $query = new WP_Query($query_args);
        $options = [];
        if($query->have_posts()):
            while ($query->have_posts()) {
                $query->the_post();
                $options[] = [ 'id' => get_the_ID(), 'text' => get_the_title() ];
            }
        endif;
        return ['results' => $options];
        wp_reset_postdata();
    }
     
    public function category(){
        $taxonomy	 = 'category';
        $query_args = [
            'taxonomy'      => ['category'], // taxonomy name
            'orderby'       => 'name', 
            'order'         => 'DESC',
            'hide_empty'    => true,
        ];

        if(isset($this->request['ids'])){
            $ids = explode(',', $this->request['ids']);
            $query_args['include'] = $ids;


            if($this->request['ids'] == ''){
                return ['results' => []];
            }
        }
        if(isset($this->request['s'])){
            $query_args['name__like'] = $this->request['s'];
        }

        $terms = get_terms( $query_args );


        $options = [];
        $count = count($terms);
        if($count > 0):
            foreach ($terms as $term) {
                $options[] = [ 'id' => $term->term_id, 'text' => $term->name ];
            }
        endif;      
        return ['results' => []];
    }
	
     
	 public function product_list(){
        $query_args = [
            'post_type'         => 'product',
            'post_status'       => 'publish',
            'posts_per_page'    => 15,
        ];

        if(isset($this->request['ids'])){
            $ids = explode(',', $this->request['ids']);
            $query_args['post__in'] = $ids;


            if($this->request['ids'] == ''){
                return ['results' => []];
            }
        }
        if(isset($this->request['s'])){
            $query_args['s'] = $this->request['s'];
        }

        $query = new WP_Query($query_args);
        $options = [];
        if($query->have_posts()):
            while ($query->have_posts()) {
                $query->the_post();
                $options[] = [ 'id' => get_the_ID(), 'text' => get_the_title() ];
            }
        endif;
        return ['results' => $options];
        wp_reset_postdata();
    }
	
    public function product_cat(){
        $query_args = [
            'taxonomy'      => ['product_cat'], // taxonomy name
            'orderby'       => 'name', 
            'order'         => 'DESC',
            'hide_empty'    => true,
        ];

        if(isset($this->request['ids'])){
            $ids = explode(',', $this->request['ids']);
            $query_args['include'] = $ids;


            if($this->request['ids'] == ''){
                return ['results' => []];
            }
        }
        if(isset($this->request['s'])){
            $query_args['name__like'] = $this->request['s'];
        }

        $terms = get_terms( $query_args );


        $options = [];
        $count = count($terms);
        if($count > 0):
            foreach ($terms as $term) {
                $options[] = [ 'id' => $term->term_id, 'text' => $term->name ];
            }
        endif;      
        return ['results' => $options];
    }	
	
	
}

function xs_ajax_select_func( WP_REST_Request $request ) {
    $class = new Xs_ajax_Api();
    return $class->action($request);
}

add_action( 'rest_api_init', function () {
    register_rest_route( 'marketoajaxselect2/v1', '/(?P<method>\w+)/', array(
        'methods' => 'GET',
        'callback' => 'xs_ajax_select_func',
        'permission_callback' => '__return_true',
    ));
});