import {View, Text, TouchableOpacity, StyleSheet, Dimensions, Image, Platform} from 'react-native';
import {useNavigation} from "@react-navigation/native";
import {useDrawerStatus} from '@react-navigation/drawer';
import {LinearGradient} from 'expo-linear-gradient';
import Format_choice from "./Format_choice";

const {height, width} = Dimensions.get('window');

const MyComponent = () => {
    const navigation = useNavigation();
    return (
        <View style={{flex: 1, backgroundColor: "#0c030c"}}>
            <LinearGradient
                // Background Linear Gradient
                colors={['rgba(63,15,64,0.9)', 'transparent']}
                style={styles.background}
            />
            <Image source={require('../assets/LOGO_LIMPRO_jaune.png')} style={styles.logo}/>
            <TouchableOpacity
                style={styles.mainButton}
                // Go to Format_choice
                onPress={() => navigation.navigate("  ")}>
                <Text style={styles.mainButtonText}>BATTLE</Text>
            </TouchableOpacity>
        </View>
    )
};

export default MyComponent;

const styles = StyleSheet.create({
    button: {
        backgroundColor: '#000',
        borderRadius: 25,
        marginBottom: 50,
        padding: 10,
        alignItems: 'center',
    },
    buttonText: {
        color: '#fff',
        fontWeight: 'bold',
    },
    mainButton: {
        shadowColor: 'rgba(75,15,77, .4)', // IOS
        shadowOffset: {height: 10, width: 10}, // IOS
        shadowOpacity: 1, // IOS
        shadowRadius: 1, //IOS
        elevation: 1, //Android (don't work)
        position: 'absolute',
        alignSelf: 'center',
        marginTop: height / 1.6,
        backgroundColor: 'yellow',
        padding: 15,
        width: 200,
        borderRadius: 25,
    },
    mainButtonText: {
        color: 'black',
        fontWeight: 'bold',
        textAlign: 'center',
        fontSize: 30
    },
    background: {
        position: 'absolute',
        left: 0,
        right: 0,
        top: 0,
        height: 900,
    },
    logo: {
        position: 'absolute',
        width: 200,
        height: 230,
        alignSelf: 'center',
        marginTop: height / 7,
        resizeMode: 'contain'
    }
});
