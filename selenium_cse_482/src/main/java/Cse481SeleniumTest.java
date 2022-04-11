import org.openqa.selenium.By;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;

public class Cse481SeleniumTest {
    public static void main(String[] args) {
        System.setProperty("webdriver.chrome.drive", "/usr/bin/chromedriver");
        WebDriver driver = new ChromeDriver();
        driver.get("http://localhost:8080/");
        getSleep(2000);
        driver.findElement(By.id("signInBtn")).click();
        getSleep(1000);

//        JavascriptExecutor js = ((JavascriptExecutor) driver);
//        js.executeScript("window.scrollTo(0, document.body.scrollHeight)");

//        long totalHeight = (long) js.executeScript("return document.body.scrollHeight");
//        System.out.println(totalHeight);
//        for (int i = 0; i< totalHeight; i+=10){
//            js.executeScript(String.format("window.scrollTo(0, %s);", i));
//        }
        getSleep(5000);

        System.out.println(driver.getTitle());

        driver.close(); // close only current windows
    }

    private static void getSleep(int time) {
        try {
            Thread.sleep(time);
        } catch (InterruptedException e) {
            e.printStackTrace();
        }
    }
}


