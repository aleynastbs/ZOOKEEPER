import java.sql.*;

public class database {
    public static void main(String[] args) throws SQLException {

        //Add jdbc to the libraries in project structure
        try{
            Class.forName("com.mysql.cj.jdbc.Driver");
        }
        catch(ClassNotFoundException e){
            System.out.println("MySQL JDBC Driver not found!");
            e.printStackTrace();
        }

        //check if your username and password from XAMPP/myPhpAdmin
        //create a database called cs353
        final String USERNAME = "root";
        final String PASSWORD = "";
        final String DBNAME = "cs353";
        final String URL = "jdbc:mysql://localhost/" + DBNAME;

        Connection connection = null;
        try{
            connection = DriverManager.getConnection(URL,USERNAME,PASSWORD);
        }
        catch(SQLException e){
            System.out.println("Connection Failed");
            e.printStackTrace();
        }
        if (connection != null){
            System.out.println("Connection established successfully");
        }
        else{
            System.out.println("Connection failed");
        }
        Statement stmt;

        try {
            stmt = connection.createStatement();
            //Drop tables if exist
            System.out.println("Dropping tables if they exist");
            stmt.executeUpdate("DROP TABLE IF EXISTS Comments");
            stmt.executeUpdate("DROP TABLE IF EXISTS Comment");
            stmt.executeUpdate("DROP TABLE IF EXISTS RespondsTo");
            stmt.executeUpdate("DROP TABLE IF EXISTS Creates_Complaint_Form");
            stmt.executeUpdate("DROP TABLE IF EXISTS Has");
            stmt.executeUpdate("DROP TABLE IF EXISTS Membership");
            stmt.executeUpdate("DROP TABLE IF EXISTS Donates");
            stmt.executeUpdate("DROP TABLE IF EXISTS Invites");
            stmt.executeUpdate("DROP TABLE IF EXISTS Attends");
            stmt.executeUpdate("DROP TABLE IF EXISTS Educational_Program");
            stmt.executeUpdate("DROP TABLE IF EXISTS Conservation_Organization");
            stmt.executeUpdate("DROP TABLE IF EXISTS Creates_Event");
            stmt.executeUpdate("DROP TABLE IF EXISTS Schedules");
            stmt.executeUpdate("DROP TABLE IF EXISTS Regularizes");
            stmt.executeUpdate("DROP TABLE IF EXISTS Food");
            stmt.executeUpdate("DROP TABLE IF EXISTS Requests");
            stmt.executeUpdate("DROP TABLE IF EXISTS Belongs_to");
            stmt.executeUpdate("DROP TABLE IF EXISTS Animal");
            stmt.executeUpdate("DROP TABLE IF EXISTS Is_In_C");
            stmt.executeUpdate("DROP TABLE IF EXISTS Is_In_S");
            stmt.executeUpdate("DROP TABLE IF EXISTS Area");
            stmt.executeUpdate("DROP TABLE IF EXISTS Sells");
            stmt.executeUpdate("DROP TABLE IF EXISTS Buys");
            stmt.executeUpdate("DROP TABLE IF EXISTS Item");
            stmt.executeUpdate("DROP TABLE IF EXISTS Shop");
            stmt.executeUpdate("DROP TABLE IF EXISTS Assigns");
            stmt.executeUpdate("DROP TABLE IF EXISTS Cage");
            stmt.executeUpdate("DROP TABLE IF EXISTS Group_Tour");
            stmt.executeUpdate("DROP TABLE IF EXISTS Event");
            stmt.executeUpdate("DROP TABLE IF EXISTS Complaint_Form");
            stmt.executeUpdate("DROP TABLE IF EXISTS Coordinator");
            stmt.executeUpdate("DROP TABLE IF EXISTS Visitor");
            stmt.executeUpdate("DROP TABLE IF EXISTS Keeper");
            stmt.executeUpdate("DROP TABLE IF EXISTS Veterinarian");
            stmt.executeUpdate("DROP TABLE IF EXISTS Employee");
            stmt.executeUpdate("DROP TABLE IF EXISTS User");

            //Create Tables
            stmt.executeUpdate("CREATE TABLE User(" +
                            "user_id INT AUTO_INCREMENT," +
                            "username VARCHAR(50) NOT NULL UNIQUE," +
                            "email VARCHAR(50) NOT NULL UNIQUE," +
                            "full_name VARCHAR(50) NOT NULL," +
                            "address VARCHAR(50) NOT NULL," +
                            "bio VARCHAR(100) NOT NULL," +
                            "birth_date DATE NOT NULL," +
                            "password VARCHAR(50) NOT NULL," +
                            "PRIMARY KEY (user_id))" +
                            "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Visitor(" +
                    "visitor_id INT," +
                    "last_visit DATE," +
                    "PRIMARY KEY (visitor_id)," +
                    "CONSTRAINT FOREIGN KEY (visitor_id) REFERENCES User(user_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Employee(" +
                    "employee_id INT," +
                    "salary INT NOT NULL," +
                    "employee_since DATE NOT NULL," +
                    "PRIMARY KEY (employee_id)," +
                    "FOREIGN KEY (employee_id) REFERENCES User(user_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Keeper(" +
                    "keeper_id INT," +
                    "PRIMARY KEY (keeper_id)," +
                    "FOREIGN KEY (keeper_id) REFERENCES Employee(employee_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Veterinarian(" +
                    "veterinarian_id INT," +
                    "speciality VARCHAR(50) NOT NULL," +
                    "PRIMARY KEY (veterinarian_id)," +
                    "FOREIGN KEY (veterinarian_id) REFERENCES Employee(employee_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Coordinator(" +
                    "coordinator_id INT," +
                    "PRIMARY KEY (coordinator_id)," +
                    "FOREIGN KEY (coordinator_id) REFERENCES Employee(employee_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Comment(" +
                    "comment_id INT AUTO_INCREMENT," +
                    "content VARCHAR(1000)," +
                    "like_amount INT NOT NULL," +
                    "dislike_amount INT NOT NULL," +
                    "PRIMARY KEY (comment_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Membership(" +
                    "membership_id INT AUTO_INCREMENT," +
                    "expiration_date DATE NOT NULL," +
                    "price INT NOT NULL," +
                    "PRIMARY KEY (membership_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Event(" +
                    "event_id INT AUTO_INCREMENT," +
                    "event_name VARCHAR (25) NOT NULL," +
                    "description VARCHAR(1000) NOT NULL," +
                    "max_capacity INT NOT NULL," +
                    "num_of_participants INT NOT NULL DEFAULT 0," +
                    "date DATE NOT NULL," +
                    "duration INT NOT NULL," +
                    "PRIMARY KEY(event_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Group_Tour( " +
                    "group_tour_id INT," +
                    "PRIMARY KEY(group_tour_id)," +
                    "FOREIGN KEY (group_tour_id) REFERENCES Event(event_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Comments(" +
                    "comment_id INT," +
                    "user_id INT," +
                    "groupTour_id INT," +
                    "PRIMARY KEY (comment_id)," +
                    "FOREIGN KEY (comment_id) REFERENCES Comment(comment_id)," +
                    "FOREIGN KEY (user_id) REFERENCES Visitor(visitor_id)," +
                    "FOREIGN KEY (groupTour_id) REFERENCES Group_Tour(group_tour_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Has(" +
                    "membership_id INT," +
                    "user_id INT," +
                    "type VARCHAR(50) NOT NULL," +
                    "PRIMARY KEY (membership_id)," +
                    "FOREIGN KEY (membership_id) REFERENCES Membership(membership_id)," +
                    "FOREIGN KEY (user_id) REFERENCES Visitor(visitor_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Educational_Program(" +
                    "edu_prog_id INT," +
                    "topic VARCHAR(20) NOT NULL," +
                    "PRIMARY KEY(edu_prog_id)," +
                    "FOREIGN KEY (edu_prog_id) REFERENCES Event(event_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Conservation_Organization(" +
                    "con_org_id INT," +
                    "goal_amount INT NOT NULL," +
                    "collected_amount INT NOT NULL DEFAULT  0," +
                    "cause VARCHAR(50) NOT NULL," +
                    "PRIMARY KEY(con_org_id)," +
                    "FOREIGN KEY (con_org_id) REFERENCES Event(event_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Attends(" +
                    "visitor_id INT," +
                    "group_tour_id INT," +
                    "requested_amount INT NOT NULL," +
                    "PRIMARY KEY(visitor_id, group_tour_id)," +
                    "FOREIGN KEY (visitor_id) REFERENCES Visitor(visitor_id)," +
                    "FOREIGN KEY (group_tour_id) REFERENCES Group_Tour(group_tour_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Creates_Event(" +
                    "coordinator_id INT," +
                    "event_id INT," +
                    "PRIMARY KEY(coordinator_id, event_id)," +
                    "FOREIGN KEY (coordinator_id)" +
                    "REFERENCES Coordinator(coordinator_id)," +
                    "FOREIGN KEY (event_id) REFERENCES Event(event_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Donates(" +
                    "visitor_id INT," +
                    "con_org_id INT," +
                    "donation_amount INT NOT NULL," +
                    "PRIMARY KEY (visitor_id, con_org_id)," +
                    "FOREIGN KEY (visitor_id) REFERENCES Visitor(visitor_id)," +
                    "FOREIGN KEY (con_org_id) REFERENCES Conservation_Organization(con_org_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Complaint_Form(" +
                    "form_id INT AUTO_INCREMENT," +
                    "form_content VARCHAR(1000) NOT NULL," +
                    "PRIMARY KEY (form_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE RespondsTo(" +
                    "form_id INT," +
                    "coordinator_id INT," +
                    "status VARCHAR(50) NOT NULL," +
                    "PRIMARY KEY (form_id)," +
                    "FOREIGN KEY (form_id) REFERENCES Complaint_Form(form_id)," +
                    "FOREIGN KEY (coordinator_id) REFERENCES Coordinator(coordinator_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Invites(" +
                    "veterinarian_id INT," +
                    "edu_prog_id INT," +
                    "coordinator_id INT," +
                    "status ENUM('REQUESTED', 'ACCEPTED', 'REJECTED')," +
                    "PRIMARY KEY (veterinarian_id, edu_prog_id, coordinator_id)," +
                    "FOREIGN KEY (coordinator_id ) REFERENCES Coordinator(coordinator_id )," +
                    "FOREIGN KEY (veterinarian_id ) REFERENCES Veterinarian(veterinarian_id)," +
                    "FOREIGN KEY (edu_prog_id ) REFERENCES Educational_Program(edu_prog_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Animal(" +
                    "animal_id INT PRIMARY KEY AUTO_INCREMENT," +
                    "animal_species VARCHAR(32) NOT NULL," +
                    "animal_name VARCHAR(32) NOT NULL)" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Food(" +
                    "food_id INT PRIMARY KEY AUTO_INCREMENT," +
                    "food_name VARCHAR(32) NOT NULL," +
                    "food_qty INT NOT NULL)" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Cage(" +
                    "cage_id INT AUTO_INCREMENT," +
                    "cage_size INT," +
                    "cage_type VARCHAR(50) NOT NULL," +
                    "PRIMARY KEY (cage_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Schedules(" +
                    "keeper_id INT," +
                    "animal_id INT," +
                    "training_description VARCHAR(200)," +
                    "training_date DATE," +
                    "PRIMARY KEY (keeper_id, animal_id)," +
                    "FOREIGN KEY (keeper_id) REFERENCES Keeper(keeper_id)," +
                    "FOREIGN KEY (animal_id) REFERENCES Animal(animal_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Regularizes(" +
                    "food_id INT," +
                    "keeper_id INT," +
                    "cage_id INT," +
                    "PRIMARY KEY (food_id, cage_id)," +
                    "FOREIGN KEY (food_id) REFERENCES Food(food_id)," +
                    "FOREIGN KEY (keeper_id) REFERENCES Keeper(keeper_id)," +
                    "FOREIGN KEY (cage_id) REFERENCES Cage(cage_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Requests(" +
                    "keeper_id INT," +
                    "veterinarian_id INT," +
                    "animal_id INT," +
                    "treatment_description VARCHAR(200)," +
                    "start_date DATE," +
                    "status ENUM('REQUESTED', 'ACCEPTED', 'REJECTED', 'ONGOING', 'FINISHED')," +
                    "PRIMARY KEY(keeper_id, veterinarian_id, animal_id)," +
                    "FOREIGN KEY (keeper_id) REFERENCES Keeper(keeper_id)," +
                    "FOREIGN KEY (veterinarian_id) REFERENCES Veterinarian(veterinarian_id)," +
                    "FOREIGN KEY (animal_id) REFERENCES Animal(animal_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Belongs_to(" +
                    "animal_id INT," +
                    "cage_id INT," +
                    "PRIMARY KEY(animal_id)," +
                    "FOREIGN KEY (animal_id) REFERENCES Animal(animal_id)," +
                    "FOREIGN KEY (cage_id) REFERENCES Cage(cage_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Creates_Complaint_Form(" +
                    "form_id INT," +
                    "visitor_id INT," +
                    "PRIMARY KEY(form_id)," +
                    "FOREIGN KEY (form_id) REFERENCES Complaint_Form(form_id)," +
                    "FOREIGN KEY (visitor_id) REFERENCES Visitor(visitor_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Area(" +
                    "area_id INT AUTO_INCREMENT," +
                    "area_name VARCHAR(50) NOT NULL," +
                    "PRIMARY KEY (area_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Shop(" +
                    "shop_id INT AUTO_INCREMENT," +
                    "shop_name VARCHAR(50) NOT NULL," +
                    "shop_description VARCHAR(50) NOT NULL," +
                    "PRIMARY KEY (shop_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Item(" +
                    "item_id INT AUTO_INCREMENT," +
                    "item_name VARCHAR(50) NOT NULL," +
                    "item_stock  INT," +
                    "item_price INT," +
                    "PRIMARY KEY (item_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Is_In_C(" +
                    "area_id  INT," +
                    "cage_id  INT," +
                    "PRIMARY KEY (cage_id)," +
                    "FOREIGN KEY (area_id) REFERENCES Area(area_id)," +
                    "FOREIGN KEY (cage_id) REFERENCES Cage(cage_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Is_In_S(" +
                    "area_id INT," +
                    "shop_id INT," +
                    "PRIMARY KEY (shop_id)," +
                    "FOREIGN KEY (area_id) REFERENCES Area(area_id)," +
                    "FOREIGN KEY (shop_id) REFERENCES Shop(shop_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Sells(" +
                    "shop_id  INT," +
                    "item_id  INT," +
                    "PRIMARY KEY (shop_id, item_id)," +
                    "FOREIGN KEY (shop_id) REFERENCES Shop(shop_id)," +
                    "FOREIGN KEY (item_id) REFERENCES Item(item_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Buys(" +
                    "item_id INT," +
                    "user_id INT," +
                    "amount INT," +
                    "PRIMARY KEY(item_id, user_id)," +
                    "FOREIGN KEY (item_id) REFERENCES Item(item_id)," +
                    "FOREIGN KEY (user_id) REFERENCES User(user_id))" +
                    "ENGINE=innodb");
            stmt.executeUpdate("CREATE TABLE Assigns(" +
                    "keeper_id INT," +
                    "cage_id INT," +
                    "coordinator_id INT," +
                    "PRIMARY KEY(keeper_id, cage_id)," +
                    "FOREIGN KEY (coordinator_id) REFERENCES Coordinator(coordinator_id)," +
                    "FOREIGN KEY (keeper_id) REFERENCES Keeper(keeper_id)," +
                    "FOREIGN KEY (cage_id) REFERENCES Cage(cage_id))" +
                    "ENGINE=innodb");

            System.out.println("--------Inserting the values---------");

            stmt.executeUpdate("INSERT INTO User(username, email, full_name, address, bio, birth_date, password) VALUES" +
                    "('aleynaS', 'as@hotmail.com', 'Aleyna Sütbaş', 'ankara', 'student', DATE '2000-08-16', 'abcd')," +
                    "('melihD', 'md@hotmail.com', 'Melih Diksu', 'ankara', 'student', DATE '2000-08-16', 'abcd')," +
                    "('laraF', 'lf@hotmail.com', 'Lara Fenercioğlu', 'ankara', 'student', DATE '2000-08-16', 'abcd')," +
                    "('berkT', 'bt@hotmail.com', 'Berk Takıt', 'ankara', 'student', DATE '1998-12-26', 'abcd');");
            stmt.executeUpdate("INSERT INTO Visitor VALUES" +
                    "(1, DATE '2021-05-10');");
            stmt.executeUpdate("INSERT INTO Employee VALUES" +
                    "(2, 1000, DATE '2020-02-10')," +
                    "(3, 1000, DATE '2020-02-10')," +
                    "(4, 1000, DATE '2020-02-10');");
            stmt.executeUpdate("INSERT INTO Keeper VALUES" +
                    "(2);");
            stmt.executeUpdate("INSERT INTO Veterinarian VALUES" +
                    "(3, 'dog');");
            stmt.executeUpdate("INSERT INTO Coordinator VALUES" +
                    "(4);");
            stmt.executeUpdate("INSERT INTO Comment(content, like_amount, dislike_amount) VALUES" +
                    "('good', 10, 5);");
            stmt.executeUpdate("INSERT INTO Membership(expiration_date, price) VALUES" +
                    "(DATE '2022-05-08', 100);");
            stmt.executeUpdate("INSERT INTO Has VALUES" +
                    "(1, 1, 'gold')");
            stmt.executeUpdate("INSERT INTO Event(event_name, description, max_capacity, num_of_participants, date, duration) VALUES" +
                    "('event1', 'fun', 100, 20, DATE '2022-05-08', 1)," +
                    "('event2', 'not fun', 50, 30, DATE '2022-07-08', 2)," +
                    "('event3', 'so fun', 150, 40, DATE '2022-06-08', 2);");
            stmt.executeUpdate("INSERT INTO Group_Tour VALUES" +
                    "(1);");
            stmt.executeUpdate("INSERT INTO Educational_Program VALUES" +
                    "(2, 'science');");
            stmt.executeUpdate("INSERT INTO Conservation_Organization VALUES" +
                    "(3, 10000, 5000, 'children');");
            stmt.executeUpdate("INSERT INTO Comments VALUES" +
                    "(1, 1, 1);");
            stmt.executeUpdate("INSERT INTO Attends VALUES" +
                    "(1,1,200);");
            stmt.executeUpdate("INSERT INTO Creates_Event VALUES" +
                    "(4,1);");
            stmt.executeUpdate("INSERT INTO Donates VALUES" +
                    "(1,3,100);");
            stmt.executeUpdate("INSERT INTO Complaint_Form(form_content) VALUES" +
                    "('tours are boring');");
            stmt.executeUpdate("INSERT INTO RespondsTo VALUES" +
                    "(1,4,'being evaluated');");
            stmt.executeUpdate("INSERT INTO Invites VALUES" +
                    "(3,2,4,'ACCEPTED');");
            stmt.executeUpdate("INSERT INTO Animal(animal_species, animal_name) VALUES" +
                    "('lion', 'jack');");
            stmt.executeUpdate("INSERT INTO Food(food_name, food_qty) VALUES" +
                    "('potato', 100);");
            stmt.executeUpdate("INSERT INTO Schedules VALUES" +
                    "(2,1,'move around', DATE '2021-05-15');");
            stmt.executeUpdate("INSERT INTO Cage(cage_size, cage_type) VALUES" +
                    "(50, 'circle');");
            stmt.executeUpdate("INSERT INTO Regularizes VALUES" +
                    "(1,2,1);");
            stmt.executeUpdate("INSERT INTO Requests VALUES" +
                    "(2,3,1,'broken leg', DATE '2021-05-17', 'ACCEPTED');");
            stmt.executeUpdate("INSERT INTO Belongs_to VALUES" +
                    "(1,1);");
            stmt.executeUpdate("INSERT INTO Area(area_name) VALUES" +
                    "('Entrance');");
            stmt.executeUpdate("INSERT INTO Shop(shop_name, shop_description) VALUES" +
                    "('Gift Shop', 'Key chains, magnets...');");
            stmt.executeUpdate("INSERT INTO Item(item_name, item_stock, item_price) VALUES" +
                    "('key chain', 10, 5)," +
                    "('magnet', 15, 10)," +
                    "('book seperator', 20, 3);");
            stmt.executeUpdate("INSERT INTO Is_In_C VALUES" +
                    "(1,1);");
            stmt.executeUpdate("INSERT INTO Is_In_S VALUES" +
                    "(1,1);");
            stmt.executeUpdate("INSERT INTO Sells VALUES" +
                    "(1,1)," +
                    "(1,2)," +
                    "(1,3);");
            stmt.executeUpdate("INSERT INTO Buys VALUES" +
                    "(1,1,1);");
            stmt.executeUpdate("INSERT INTO Assigns VALUES" +
                    "(2,1,4);");
            stmt.executeUpdate("INSERT INTO Creates_Complaint_Form VALUES" +
                    "(1,1);");

        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
}
