#Kohana-sagui
Módulo MongoDB par aKohana

####Exemplo de uso:

	$mongoDB = new Sagui();
    
    //recuperar a coleção
    $collection = $mongoDB->get_collection('my_collection', TRUE);
    
    //inserir dados
    $data = array('name' => 'king kong', 'age' => 30 );
    $insert = $mongoDB->insert_in_collection('my_collection', $data); 
    
    //remover dados
    $collection->remove(array('id' => $id));




##Exemplos e documentação PHP



###Opções de configuraçoes do PHP

	http://www.php.net/manual/en/mongo.construct.php
	

    
####Conexão

	$connection = new Mongo("mongodb://mongolab_user:mongolab_password@dbh45.mongolab.com:27457/cache_test");
	
	$connection = new Mongo("dbh45.mongolab.com:27457", array("persist" => "x"));
    
    $connection = new Mongo("127.0.0.1:27017", array("persist" => "x"));
  
    
####Seleção do Banco
    
    $db = $connection->cache_testy; 
    
  
####Autenticação

    $db->authenticate('mongolab_user', 'mongolab_password');                        
                          
    
####Seleção da Coleção

    $collection = $db->mongotest;

 
    
###Inserção do documento na coleção
    
    $obj = array( "_id" => "keyid", "author" => "Bill Watterson" );
    $collection->insert($obj);
  
    $obj = array( "title" => "Luiz Alberto", "author" => "Bill Watterson" );
    $collection->insert($obj);

    $obj = array( "title" => "Rachel Alves", "online" => true );
    $collection->insert($obj);
    
    
###Contar objetos na coleção

    echo $collection->count();

   
####Resgatar um objeto da coleção

    $obj = $collection->findOne();

    $obj = $collection->findOne(array('_id' => new MongoId('4ece67dc584e86fd47000000')));
    
    $obj = $collection->findOne(array('title' => 'XKCD'), array('online'));

####Resgatar vários objetos da coleção
    $cursor = $collection->find(array('title' => array('$exists' => TRUE)));
    foreach ($cursor as $obj) {            
      echo Kohana::debug($obj);
    }
  
    $cursor = $collection->find(array('online' => array('$exists' => TRUE)));
    foreach ($cursor as $obj) {            
      echo Kohana::debug($obj);
    }
    
    
    $cursor = $collection->find(array('versions' => array('$in' => array('0.9.7'))));
    foreach ($cursor as $obj) {            
        echo Kohana::debug($obj);
    }
    
    
    $cursor = $collection->find();
    foreach ($cursor as $obj) {            
        echo Kohana::debug($obj);
    }
    
    
    $query = array("title" => 'XKCD');
    $cursor = $collection->find( $query );
    while( $cursor->hasNext() ) {
      var_dump( $cursor->getNext() );
     }
  
####Remover todos os objetos da coleção
    $collection->remove();
  
    
####Remover objetos de acordo com a query
    
    //remove documentos com value > 7
    $query = array('value' => array('$gt' => 7));
    $collection->remove($query);
  
  
    //remove documentos com value < 7
    $query = array('value' => array('$lt' => 7));
    $collection->remove($query); 
    
    
####SELECT DISTINCT

    $query = array("distinct" => "collection_name", 
                    "key" => "user_id",
                    "query" => array("field" => $value)
                    );
    
    $selected_users = $mongo->command($query);
    
    foreach($selected_users['values'] as $data_user){
        echo Kohana::debug($data_user);  
        
    }

  
### Mais Exemplos & Documentação	
    
* http://php.net/manual/en/mongo.construct.php
* http://php.net/manual/en/mongocollection.findone.php
* http://php.net/manual/pt_BR/mongodb.createcollection.php
* http://br.php.net/manual/pt_BR/mongodb.command.php
* http://www.php.net/manual/en/mongo.sqltomongo.php
* http://www.mongodb.org/display/DOCS/SQL+to+Mongo+Mapping+Chart